<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // tu Blade con el formulario
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo'     => 'required|email',
            'contraseña' => 'required|min:8',
        ]);

        // Llamada al API Node
        $response = Http::post(config('app.api_url') . '/login', [
            'correo'     => $request->correo,
            'contraseña' => $request->contraseña,
        ]);

        if (! $response->successful()) {
            // Puedes extraer el mensaje de error del API
            $error = $response->json('mensaje', 'Error al iniciar sesión');
            return back()
                ->withInput($request->only('correo'))
                ->withErrors(['login' => $error]);
        }

        $data = $response->json();

        // Guardar token y datos en sesión
        session([
            'token'    => $data['token'],
            'userRol'  => $data['rol'],
            'userId'   => json_decode(base64_decode(explode('.', $data['token'])[1]), true)['id'],
            'nombre'   => json_decode(base64_decode(explode('.', $data['token'])[1]), true)['nombre'],
        ]);

        // Redirigir según rol
        switch ($data['rol']) {
            case 'admin':
                return redirect()->route('dashboard.admin.profile');
            case 'nutriologo':
                return redirect()->route('dashboard.nutriologo.profile');
            case 'paciente':
                return redirect('/dashboard/paciente');
            default:
                // auth()->logout();
                // return back()->withErrors(['login' => 'Rol no reconocido']);
        }
    }
}
