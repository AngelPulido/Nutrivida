<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PacienteController extends Controller
{
    // Obtener planes nutricionales
    public function misPlanes()
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url').'/my-plans');
            
        $planes = $response->successful() ? $response->json() : [];
        
        return view('dashboard.paciente.planes', [
            'planes' => $planes['data'] ?? $planes
        ]);
    }

    // Obtener citas programadas
    public function misCitas()
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url').'/my-appointments');
            
        $citas = $response->successful() ? $response->json() : [];
        
        return view('paciente.citas', [
            'citas' => $citas['data'] ?? $citas
        ]);
    }

    // Solicitar nueva cita
    public function solicitarCita(Request $request)
    {
        $request->validate([
            'nutriologo_id' => 'required|numeric',
            'fecha' => 'required|date',
            'notas' => 'nullable|string|max:500'
        ]);

        $response = Http::withToken(session('token'))
            ->post(config('app.api_url').'/appointments', $request->all());

        if ($response->successful()) {
            return back()->with('success', 'Cita solicitada correctamente');
        }

        return back()->with('error', 'Error al solicitar cita: '.$response->json()['mensaje'] ?? '');
    }

    // Vista de progreso
    public function miProgreso()
    {
        return view('dashboard.paciente.progreso');
    }

    // Registrar progreso físico
    public function registrarProgreso(Request $request)
    {
        $request->validate([
            'peso_kg' => 'required|numeric',
            'fecha_registro' => 'required|date',
            'grasa_corporal_pct' => 'nullable|numeric',
            'masa_muscular_pct' => 'nullable|numeric',
            'foto_progreso' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('foto_progreso');
        
        if ($request->hasFile('foto_progreso')) {
            $data['foto_progreso'] = $request->file('foto_progreso')->store('progresos');
        }

        $response = Http::withToken(session('token'))
            ->post(config('app.api_url').'/progress', $data);

        if ($response->successful()) {
            return back()->with('success', 'Progreso registrado correctamente');
        }

        return back()->with('error', 'Error: '.$response->json()['mensaje'] ?? 'Error al registrar progreso');
    }
}