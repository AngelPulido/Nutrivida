<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'nombre'     => 'required|min:3',
            'correo'     => 'required|email',
            'contraseña' => 'required|min:8',
            'rol'        => 'required|in:paciente,nutriologo',
        ]);

        // Llamada al API externo
        $response = Http::post(config('app.api_url') . '/register', [
            'nombre'     => $request->nombre,
            'correo'     => $request->correo,
            'contraseña' => $request->contraseña,
            'rol'        => $request->rol,
        ]);

        if ($response->status() === 409) {
            return back()
                ->withInput($request->only('nombre','correo','rol'))
                ->withErrors(['register' => $response->json('mensaje')]);
        }

        if (! $response->successful()) {
            $error = $response->json('mensaje', 'Error al registrarse');
            return back()
                ->withInput($request->only('nombre','correo','rol'))
                ->withErrors(['register' => $error]);
        }

        return redirect()->route('login.form')
                         ->with('success', $response->json('mensaje', 'Registro exitoso'));
    }
}
