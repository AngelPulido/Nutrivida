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

    // Asegurar estructura mínima para citas y progresos
    $stats['citas']['por_mes'] = $stats['citas']['por_mes'] ?? [];
    $stats['progresos_fisicos']['por_mes'] = $stats['progresos_fisicos']['por_mes'] ?? [];

    return view('dashboard.admin.statistics', [
        'stats' => $stats,
        'chartData' => $this->prepareChartData($stats)
    ]);
}

private function prepareChartData($stats)
{
    return [
        'user_distribution' => [
            'labels' => ['Administradores', 'Nutriólogos', 'Pacientes'],
            'data' => [
                $stats['usuarios']['admin'] ?? 0,
                $stats['usuarios']['nutriologo'] ?? 0,
                $stats['usuarios']['paciente'] ?? 0
            ],
            'colors' => ['#6366F1', '#3B82F6', '#10B981']
        ],
        'monthly_activity' => [
            'labels' => array_column($stats['usuarios_por_mes'] ?? [], 'mes'),
            'datasets' => [
                [
                    'label' => 'Usuarios nuevos',
                    'data' => array_column($stats['usuarios_por_mes'] ?? [], 'total'),
                    'borderColor' => '#6366F1',
                    'backgroundColor' => 'rgba(99, 102, 241, 0.1)'
                ]
            ]
        ]
    ];
}
}