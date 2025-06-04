<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;


class AdminUserController extends Controller
{
    protected $apiBase;
    protected $token;

    public function __construct()
    {
        $this->apiBase = config('app.api_url');
        $this->token   = session('token');
    }

    /** Listar todos los usuarios con paginación */
    public function index(Request $request)
    {
        // 1) Traemos TODOS los usuarios desde la API
        $resp = Http::withToken($this->token)
                    ->get("{$this->apiBase}/users");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        // 2) Convertimos cada usuario a objeto y le anexamos perfil
        $allUsers = collect($resp->json())->map(function($u) {
            $user = (object)$u;
            $user->perfil = (object)[
                'nombre'       => $u['nombre']       ?? null,
                'avatar'       => $u['avatar']       ?? null,
                'telefono'     => $u['telefono']     ?? null,
                'edad'         => $u['edad']         ?? null,
                'genero'       => $u['genero']       ?? null,
                'direccion'    => $u['direccion']    ?? null,
                'altura_cm'    => $u['altura_cm']    ?? null,
                'peso_kg'      => $u['peso_kg']      ?? null,
                'especialidad' => $u['especialidad'] ?? null,
            ];
            return $user;
        })->toArray(); // convertimos a array indexado

        // 3) Parámetros de paginación
        //    - Obtener página actual (por query string ?page=)
        $page    = $request->input('page', 1);
        //    - Definir cuántos ítems queremos por página
        $perPage = 9;
        //    - Calcular offset
        $offset  = ($page - 1) * $perPage;

        // 4) Cortar el array completo para quedarnos SOLO con los usuarios de la página actual
        $currentPageItems = array_slice($allUsers, $offset, $perPage);

        // 5) Construir un LengthAwarePaginator
        $paginator = new LengthAwarePaginator(
            $currentPageItems,           // items de la página actual
            count($allUsers),            // total de ítems en la colección original
            $perPage,                    // ítems por página
            $page,                       // página actual
            [
                'path'  => $request->url(),       // URL base 
                'query' => $request->query(),     // Mantener otros parámetros (si existieran)
            ]
        );

        // 6) Pasar el paginador a la vista
        return view('dashboard.admin.users.index', [
            'users' => $paginator
        ]);
    }   

    /** Almacena un nuevo usuario */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'correo'       => 'required|email|max:255|unique:usuarios',
            'contraseña'   => 'required|string|min:8',
            'rol'          => 'required|in:admin,nutriologo,paciente',
            'telefono'     => 'nullable|string|max:20',
            'edad'         => 'nullable|integer|min:1',
            'genero'       => 'nullable|string|in:masculino,femenino,otro',
            'direccion'   => 'nullable|string|max:255',
            'altura_cm'    => 'nullable|numeric|min:0',
            'peso_kg'      => 'nullable|numeric|min:0',
            'especialidad' => 'nullable|string|max:255' // Solo para nutriólogos
        ]);

        $resp = Http::withToken($this->token)
                    ->post("{$this->apiBase}/users", $data);

        if (!$resp->successful()) {
            return back()
                ->withErrors(['store' => $resp->json('mensaje')])
                ->withInput();
        }

        return redirect()
            ->route('dashboard.admin.users.index')
            ->with('success', 'Usuario y perfil creados correctamente');
    }

    /** Ver detalle de un usuario */
    public function show($id)
    {
        $resp = Http::withToken($this->token)
                ->get("{$this->apiBase}/users/{$id}");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        $userData = $resp->json();
        
        // Convertir a objeto de forma segura
        $user = (object)$userData;
        
        // Manejar el perfil de forma segura
        $defaultProfile = [
            'telefono' => null,
            'edad' => null,
            'genero' => null,
            'direccion' => null,
            'altura_cm' => null,
            'peso_kg' => null,
            'especialidad' => null,
            'avatar' => null, // Añadir campo para el avatar
        ];
        
        $perfil = isset($userData['perfil']) && is_array($userData['perfil']) ? 
                (object)array_merge($defaultProfile, $userData['perfil']) : 
                (object)$defaultProfile;

        return view('dashboard.admin.users.show', [
            'user' => $user,
            'perfil' => $perfil
        ]);
    }

    /** Muestra formulario de edición */
    public function edit($id)
    {
        $resp = Http::withToken($this->token)
                    ->get("{$this->apiBase}/users/{$id}");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        $userData = $resp->json();
        
        // Convertir a objeto de forma segura
        $user = (object)$userData;
        
        // Definir estructura completa del perfil con valores por defecto
        $defaultProfile = [
            'telefono' => null,
            'edad' => null,
            'genero' => null,
            'direccion' => null,
            'altura_cm' => null,
            'peso_kg' => null,
            'especialidad' => null
        ];
        
        // Combinar con datos reales si existen
        $perfilData = isset($userData['perfil']) && is_array($userData['perfil']) ? 
                    array_merge($defaultProfile, $userData['perfil']) : 
                    $defaultProfile;
        
        $perfil = (object)$perfilData;

        return view('dashboard.admin.users.edit', [
            'user' => $user,
            'perfil' => $perfil
        ]);
    }

    public function update(Request $request, $id)
{
    // 1. Obtener usuario actual
    $userResponse = Http::withToken($this->token)
                       ->get("{$this->apiBase}/users/{$id}");
    
    if (!$userResponse->successful()) {
        return back()->withErrors(['error' => 'No se pudo obtener el usuario']);
    }
    
    $userData   = $userResponse->json();
    $currentRole = $userData['rol'] ?? 'paciente';

    // 2. Reglas de validación (usando nombres SIN tildes como en el formulario)
    $rules = [
        'nombre'    => 'required|string|max:255',
        'correo'    => 'required|email|max:255',
        'contraseña'=> 'nullable|string|min:8',
        'telefono'  => 'required|string|max:20',
        'edad'      => 'required|integer|min:1',
        'genero'    => 'required|in:masculino,femenino,otro',
        'direccion' => 'required|string|max:255',
    ];

    if ($currentRole === 'nutriologo') {
        $rules['especialidad'] = 'required|string|max:255';
    } elseif ($currentRole === 'paciente') {
        $rules['altura_cm'] = 'required|numeric|min:0';
        $rules['peso_kg']   = 'required|numeric|min:0';
    }

    $validatedData = $request->validate($rules);

    // 5. Mapear a los nombres que espera la API (CON tildes)
    $apiData = [
        'nombre'    => $validatedData['nombre'],
        'correo'    => $validatedData['correo'],
        'telefono'  => $validatedData['telefono'],
        'edad'      => $validatedData['edad'],
        'genero'    => $validatedData['genero'],
        'direccion' => $validatedData['direccion'],
        // AGREGAMOS EL ROL AQUÍ
        'rol'       => $currentRole,
    ];

    if ($currentRole === 'nutriologo') {
        $apiData['especialidad'] = $validatedData['especialidad'];
    } elseif ($currentRole === 'paciente') {
        $apiData['altura_cm'] = $validatedData['altura_cm'];
        $apiData['peso_kg']   = $validatedData['peso_kg'];
    }

    if (!empty($validatedData['contraseña'])) {
        $apiData['contraseña'] = $validatedData['contraseña'];
    }

    // 8. Enviar a la API (AHORA 'rol' viaja dentro de $apiData)
    $response = Http::withToken($this->token)
                   ->put("{$this->apiBase}/users/{$id}", $apiData);

    if (!$response->successful()) {
        $errorDetails = $response->json();
        logger()->error('Error al actualizar usuario', [
            'status'   => $response->status(),
            'error'    => $errorDetails,
            'sent_data'=> $apiData
        ]);
        
        return back()
               ->withErrors(['api_error' => $errorDetails['mensaje'] ?? 'Error al actualizar'])
               ->withInput();
    }

    return redirect()
           ->route('dashboard.admin.users.show', $id)
           ->with('success', 'Usuario actualizado correctamente');
}


    /** Elimina un usuario */
    public function destroy($id)
    {
        $resp = Http::withToken($this->token)
                    ->delete("{$this->apiBase}/users/{$id}");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        return redirect()
            ->route('dashboard.admin.users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
     public function create()
    {
        return view('dashboard.admin.users.create');
    }
}