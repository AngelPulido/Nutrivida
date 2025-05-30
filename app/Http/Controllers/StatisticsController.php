<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StatisticsController extends Controller
{
    public function index()
    {
        $apiBase = config('app.api_url');
        $token = session('token');

        $response = Http::withToken($token)
            ->get("{$apiBase}/statistics");

        if (!$response->successful()) {
            abort(500, 'Error al obtener estadísticas');
        }

        $stats = $response->json();

        // Preparar datos para los gráficos
        $chartData = [
            'usuarios' => [
                'labels' => ['Administradores', 'Nutriólogos', 'Pacientes'],
                'data' => [
                    $stats['usuarios']['admin'],
                    $stats['usuarios']['nutriologo'],
                    $stats['usuarios']['paciente']
                ],
                'colors' => ['#6366F1', '#3B82F6', '#10B981']
            ],
            'actividad' => [
                'labels' => ['Citas', 'Progresos'],
                'data' => [
                    $stats['citas']['este_mes'],
                    $stats['progresos_fisicos']['este_mes']
                ],
                'colors' => ['#F59E0B', '#EC4899']
            ]
        ];

        return view('dashboard.admin.statistics', [
            'stats' => $stats,
            'chartData' => $chartData
        ]);
    }
}