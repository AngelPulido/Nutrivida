<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminUserController extends Controller
{
    protected $apiBase;
    protected $token;

    public function __construct()
    {
        $this->apiBase = config('app.api_url');
        $this->token   = session('token');
    }

    /** Listar todos los usuarios */
    public function index()
    {
        $resp = Http::withToken($this->token)
                ->get("{$this->apiBase}/users");

            abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

            // Obtienes el array inicial
            $usersArray = $resp->json();

            // Conviertes cada elemento en objeto
            $users = array_map(fn($u) => (object)$u, $usersArray);

            return view('dashboard.admin.users.index', [
                'users' => $users
            ]);
    }

    /** Muestra formulario de creación */
    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    /** Almacena un nuevo usuario */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'correo'       => 'required|email|max:255',
            'contraseña'   => 'required|string|min:8',
            'rol'          => 'required|in:admin,nutriologo,paciente',
        ]);

        $resp = Http::withToken($this->token)
                    ->post("{$this->apiBase}/users", $data);

        if (! $resp->successful()) {
            return back()
                ->withErrors(['store' => $resp->json('mensaje')])
                ->withInput();
        }

        return redirect()
            ->route('dashboard.admin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    /** Ver detalle de un usuario */
    public function show($id)
    {
        $resp = Http::withToken($this->token)
                    ->get("{$this->apiBase}/users/{$id}");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        $user = $resp->json();

        return view('dashboard.admin.users.show', [
            'user' => (object)$user
        ]);
    }

    /** Muestra formulario de edición */
    public function edit($id)
    {
        $resp = Http::withToken($this->token)
                    ->get("{$this->apiBase}/users/{$id}");

        abort_unless($resp->successful(), $resp->status(), $resp->json('mensaje'));

        $user = $resp->json();

        return view('dashboard.admin.users.edit', [
            'user' => (object)$user
        ]);
    }

    /** Actualiza un usuario existente */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'correo'       => 'required|email|max:255',
            'rol'          => 'required|in:admin,nutriologo,paciente',
            'contraseña'   => 'nullable|string|min:8',
        ]);

        $resp = Http::withToken($this->token)
                    ->put("{$this->apiBase}/users/{$id}", $data);

        if (! $resp->successful()) {
            return back()
                ->withErrors(['update' => $resp->json('mensaje')])
                ->withInput();
        }

        return redirect()
            ->route('dashboard.admin.users.index')
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
}
