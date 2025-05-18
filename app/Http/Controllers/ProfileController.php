<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    protected $apiBase;

    public function __construct()
    {
        $this->apiBase = config('app.api_url');
    }

    /** Muestra el formulario inicial de profile */
    public function show(Request $request)
    {
       $role = $request->route('role');
    $resp = Http::withToken(session('token'))
                ->get("{$this->apiBase}/profile");

    if (! $resp->successful()) {
        abort($resp->status(), $resp->json('mensaje'));
    }

    $userData = $resp->json();          // trae: id, nombre, correo, perfil => array|null
    $perfil   = $userData['perfil'] ?? null;

    // Lista de campos que consideras obligatorios para dar el perfil por "completo"
    $camposObligatorios = ['telefono', 'edad', 'genero', 'direccion'];

    $incompleto = true;
    if ($perfil) {
        // Si alguno de los obligatorios está aun null ó vacío, sigue incompleto
        $incompleto = false;
        foreach ($camposObligatorios as $campo) {
            if (! isset($perfil[$campo]) || $perfil[$campo] === null || $perfil[$campo] === '') {
                $incompleto = true;
                break;
            }
        }
    }

    if ($incompleto) {
        // No hay perfil o faltan datos → muestro el formulario para completar
        return view("dashboard.{$role}.profile", [
            'user' => (object)$userData
        ]);
    }

    // Perfil existe y está completo → voy a la vista “mi perfil”
    return redirect()->route("dashboard.{$role}.miperfil");
    }

    /** Procesa el PUT de profile (crea o actualiza perfil) */
   public function update(Request $request)
{
    $role = $request->route('role');

    // 1) Valida todos los campos
    $validated = $request->validate([
        'nombre'       => 'required|string|max:255',
        'telefono'     => 'nullable|digits_between:7,15',
        'edad'         => 'nullable|integer|min:0|max:150',
        'genero'       => 'nullable|in:Masculino,Femenino,Otro',
        'especialidad' => 'nullable|string|max:255',
        'direccion'    => 'nullable|string|max:255',
        'peso_kg'         => 'nullable|numeric|min:0',   // KG
        'altura_cm'       => 'nullable|numeric|min:0',   // CM
        'avatar'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'cover_photo'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
    ]);

    // 2) Si hay avatar, lo guardo y pongo el nombre en el payload
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $validated['avatar'] = basename($path);
    }

    // 3) Si hay cover_photo, igual
    if ($request->hasFile('cover_photo')) {
        $path = $request->file('cover_photo')->store('covers', 'public');
        $validated['cover_photo'] = basename($path);
    }

    // 4) Llamada al API con TODO el payload
    $resp = Http::withToken(session('token'))
               ->put("{$this->apiBase}/profile", $validated);

    if (! $resp->successful()) {
        return back()
            ->withErrors(['profile' => $resp->json('mensaje')])
            ->withInput();
    }

    // 5) Redirect con éxito
    return redirect()
        ->route("dashboard.{$role}.miperfil")
        ->with('success', 'Perfil guardado correctamente');
    }

    public function myProfile(Request $request)
    {
        $role = $request->route('role');

        $resp = Http::withToken(session('token'))
                    ->get("{$this->apiBase}/profile");

        if (! $resp->successful()) {
            abort($resp->status(), $resp->json('mensaje'));
        }

        $userData = $resp->json();

        // Si viene perfil en array, conviértelo a objeto para usar -> en Blade
        if (! empty($userData['perfil'])) {
            $userData['perfil'] = (object) $userData['perfil'];
        }

        return view("dashboard.{$role}.miperfil", [
            'user' => (object) $userData
        ]);
    }
}