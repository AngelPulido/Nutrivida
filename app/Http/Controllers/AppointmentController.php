<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('dashboard.nutriologo.citas');
    }

    public function getAppointments()
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url').'/appointments');
            
        if ($response->successful()) {
            $appointments = $response->json();
            
            // Formatear para FullCalendar
            $formattedAppointments = array_map(function($appointment) {
                $color = $this->getStatusColor($appointment['estado']);
                return [
                    'id' => $appointment['id'],
                    'title' => $appointment['paciente'],
                    'start' => $appointment['fecha'],
                    'color' => $color,
                    'extendedProps' => [
                        'status' => $appointment['estado'],
                        'patient' => $appointment['paciente']
                    ]
                ];
            }, $appointments);
            
            return response()->json($formattedAppointments);
        }
        
        return response()->json(['error' => 'Error al obtener citas'], 500);
    }

    public function update($id)
    {
        $validated = request()->validate([
            'estado' => 'required|in:pendiente,aprobada,rechazada,reprogramada,completada'
        ]);

        $response = Http::withToken(session('token'))
            ->put(config('app.api_url')."/appointments/{$id}", $validated);
            
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => $response->json()['mensaje'] ?? 'Estado de la cita actualizado'
            ]);
        }
        
        return response()->json([
            'error' => $response->json()['mensaje'] ?? 'Error al actualizar cita'
        ], $response->status());
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'pendiente': return '#3b82f6'; // azul
            case 'aprobada': return '#10b981'; // verde
            case 'rechazada': return '#ef4444'; // rojo
            case 'reprogramada': return '#8b5cf6'; // violeta
            case 'completada': return '#8b5cf6'; // violeta
            default: return '#6b7280'; // gris
        }
    }
}