<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $apiBase;

    public function __construct()
    {
        $this->apiBase = config('app.api_url');
    }

    public function show(Request $request)
    {
        $role = $request->route('role');
        $resp = Http::withToken(session('token'))
                   ->get("{$this->apiBase}/profile");

        if (!$resp->successful()) {
            abort($resp->status(), $resp->json('mensaje'));
        }

        $userData = $resp->json();
        $userData['perfil'] = !empty($userData['perfil']) ? (object)$userData['perfil'] : null;

        return view("dashboard.{$role}.profile", [
            'user' => (object)$userData
        ]);
    }

    public function update(Request $request)
    {
        $role = $request->route('role');
        
        // Obtener datos actuales del usuario
        $currentData = Http::withToken(session('token'))
                         ->get("{$this->apiBase}/profile")
                         ->json();
        $currentProfile = $currentData['perfil'] ?? [];

        // Validación
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|digits_between:7,15',
            'edad' => 'nullable|integer|min:0|max:150',
            'genero' => 'nullable|in:Masculino,Femenino,Otro',
            'especialidad' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'peso_kg' => 'nullable|numeric|min:0',
            'altura_cm' => 'nullable|numeric|min:0',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'cover_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'remove_avatar' => 'nullable|boolean',
            'remove_cover_photo' => 'nullable|boolean'
        ]);

        // Manejo de avatar
        if ($request->hasFile('avatar')) {
            // Eliminar avatar anterior si existe
            if (!empty($currentProfile['avatar'])) {
                Storage::disk('public')->delete('avatars/'.$currentProfile['avatar']);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = basename($path);
        } elseif ($request->input('remove_avatar')) {
            // Eliminar avatar si se marca el checkbox
            if (!empty($currentProfile['avatar'])) {
                Storage::disk('public')->delete('avatars/'.$currentProfile['avatar']);
            }
            $validated['avatar'] = null;
        } else {
            // Mantener el avatar existente si no hay cambios
            $validated['avatar'] = $currentProfile['avatar'] ?? null;
        }

        // Manejo de cover_photo
        if ($request->hasFile('cover_photo')) {
            // Eliminar cover_photo anterior si existe
            if (!empty($currentProfile['cover_photo'])) {
                Storage::disk('public')->delete('covers/'.$currentProfile['cover_photo']);
            }
            $path = $request->file('cover_photo')->store('covers', 'public');
            $validated['cover_photo'] = basename($path);
        } elseif ($request->input('remove_cover_photo')) {
            // Eliminar cover_photo si se marca el checkbox
            if (!empty($currentProfile['cover_photo'])) {
                Storage::disk('public')->delete('covers/'.$currentProfile['cover_photo']);
            }
            $validated['cover_photo'] = null;
        } else {
            // Mantener el cover_photo existente si no hay cambios
            $validated['cover_photo'] = $currentProfile['cover_photo'] ?? null;
        }

        // Llamada al API
        $resp = Http::withToken(session('token'))
                   ->put("{$this->apiBase}/profile", $validated);

        if (!$resp->successful()) {
            return back()
                ->withErrors(['profile' => $resp->json('mensaje')])
                ->withInput();
        }

        return redirect()
            ->route("dashboard.{$role}.miperfil")
            ->with('success', 'Perfil actualizado correctamente');
    }

    public function myProfile(Request $request)
    {
        $role = $request->route('role');
        $resp = Http::withToken(session('token'))
                   ->get("{$this->apiBase}/profile");

        if (!$resp->successful()) {
            abort($resp->status(), $resp->json('mensaje'));
        }

        $userData = $resp->json();
        if (!empty($userData['perfil'])) {
            $userData['perfil'] = (object) $userData['perfil'];
        }

        return view("dashboard.{$role}.miperfil", [
            'user' => (object) $userData
        ]);
    }
}