<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('token')) {
            // Si es petición AJAX, devolvemos 401 JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'mensaje' => 'No autenticado'
                ], 401);
            }
            // Redirigir al formulario de login
            return redirect()->route('login.form');
        }
        
        return $next($request);
    }
}
