<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    public function index()
    {
        try {
            $nutriologoId = auth()->id();
            
            $response = Http::withToken(session('token'))
                ->timeout(30)
                ->get(config('app.api_url').'/appointments', [
                    'nutriologo_id' => $nutriologoId
                ]);
    
            if (!$response->successful()) {
                throw new \Exception("API Error: ".$response->body());
            }
    
            $data = $response->json();
            
            // Normalizar estructura de datos
            $appointments = array_map(function($item) {
                return [
                    'id' => $item['id'] ?? null,
                    'paciente_id' => $item['paciente_id'] ?? null,
                    'paciente_nombre' => $item['paciente']['nombre'] ?? $item['paciente_nombre'] ?? 'Paciente',
                    'fecha' => $item['fecha'] ?? now()->format('Y-m-d H:i:s'),
                    'estado' => $item['estado'] ?? 'pendiente',
                    'notas' => $item['notas'] ?? 'Sin notas',
                    'reprogramado_en' => $item['reprogramado_en'] ?? null
                ];
            }, $data['data'] ?? $data);
    
            return view('dashboard.nutriologo.citas', [
                'appointments' => $appointments
            ]);
    
        } catch (\Exception $e) {
            \Log::error('CitasController Error: '.$e->getMessage());
            return view('dashboard.nutriologo.citas', [
                'appointments' => [],
                'error' => 'Error al cargar citas'
            ]);
        }
    }

    public function update($id)
    {
        $response = Http::withToken(session('token'))
            ->put(config('app.api_url')."/api/appointments/{$id}", request()->all());
            
        if ($response->successful()) {
            return back()->with('success', 'Estado de cita actualizado');
        }
        
        return back()->with('error', 'Error al actualizar cita');
    }
}