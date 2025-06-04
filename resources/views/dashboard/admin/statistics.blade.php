<x-layouts.app title="Estadísticas" metaDescription="Estadísticas del sistema">
    <style>
      .gradient-bg {
        background: linear-gradient(135deg, #34D399 0%, #10B981 100%);
      }
      .chart-card {
        transition: all 0.3s ease;
      }
      .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      }
    </style>

  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64 bg-white shadow-md"><x-layouts.navAdmin /></aside>

    <main class="flex-1 p-6 overflow-y-auto">
      <div class="max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="gradient-bg rounded-xl p-6 shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-white">Panel de Estadísticas</h1>
              <p class="mt-2 text-gray-200">Resumen completo del sistema</p>
            </div>
            <div class="text-white">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {{-- Usuarios Card --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden chart-card">
            <div class="p-6">
              <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-medium text-gray-500">Usuarios</h3>
                  <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($stats['usuarios']['total'] ?? 0) }}
                  </p>
                </div>
              </div>
              <div class="mt-4 h-40">
                <canvas id="usersChart"></canvas>
              </div>
            </div>
          </div>

          {{-- Citas Card --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden chart-card">
            <div class="p-6">
              <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-medium text-gray-500">Citas</h3>
                  <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($stats['citas']['total'] ?? 0) }}
                  </p>
                </div>
              </div>
              <div class="mt-4 h-40">
                <canvas id="appointmentsChart"></canvas>
              </div>
            </div>
          </div>

          {{-- Mensajes Card --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden chart-card">
            <div class="p-6">
              <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-medium text-gray-500">Mensajes</h3>
                  <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($stats['mensajes'] ?? 0) }}
                  </p>
                </div>
              </div>
              <div class="mt-4 flex items-center justify-center h-40">
                <div class="text-center">
                  @php
                    $totalUsuarios = $stats['usuarios']['total'] ?? 1;
                    $totalMensajes = $stats['mensajes'] ?? 0;
                    $interactionRate = $totalUsuarios > 0
                      ? round(($totalMensajes / $totalUsuarios) * 100)
                      : 0;
                  @endphp
                  <div class="text-5xl font-bold text-green-600">
                    {{ $interactionRate }}%
                  </div>
                  <p class="mt-2 text-gray-500">Tasa de interacción</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Progresos Card --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden chart-card">
            <div class="p-6">
              <div class="flex items-center">
                <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-medium text-gray-500">Progresos</h3>
                  <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($stats['progresos_fisicos']['total'] ?? 0) }}
                  </p>
                </div>
              </div>
              <div class="mt-4 h-40">
                <canvas id="progressChart"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Detailed Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {{-- Actividad Mensual --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 chart-card">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Actividad Mensual</h3>
            <div class="h-80">
              <canvas id="monthlyActivityChart"></canvas>
            </div>
          </div>

          {{-- Distribución de Usuarios --}}
          <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 chart-card">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Distribución de Usuarios</h3>
            <div class="h-80">
              <canvas id="userDistributionChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Recent Stats Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden chart-card">
          <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Resumen Detallado</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Métrica
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Total
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Este Mes
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tendencia
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                {{-- USUARIOS REGISTRADOS --}}
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Usuarios Registrados</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ number_format($stats['usuarios']['total'] ?? 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @php
                      $uSlice   = $stats['usuarios_por_mes'] ?? [];
                      $lastIdx  = count($uSlice) - 1;
                      $ultimoMes = 0;
                      if (isset($uSlice[$lastIdx]) && isset($uSlice[$lastIdx]['total'])) {
                        $ultimoMes = $uSlice[$lastIdx]['total'];
                      }
                    @endphp
                    {{ number_format($ultimoMes) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                      $prevIdx   = max($lastIdx - 1, 0);
                      $anteriorU = isset($uSlice[$prevIdx]['total']) ? $uSlice[$prevIdx]['total'] : 1;
                      if ($anteriorU <= 0) {
                        $porcU = 0;
                      } else {
                        $porcU = round((($ultimoMes / $anteriorU) * 100) - 100);
                      }
                    @endphp
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $porcU >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                      {{ $porcU >= 0 ? '+' . $porcU . '%' : $porcU . '%' }}
                    </span>
                  </td>
                </tr>

                {{-- CITAS PROGRAMADAS --}}
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Citas Programadas</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ number_format($stats['citas']['total'] ?? 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ number_format($stats['citas']['este_mes'] ?? 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                      $cSlice    = $stats['citas']['por_mes'] ?? [];
                      $cLastIdx  = count($cSlice) - 1;
                      $cUltimo   = 0;
                      if (isset($cSlice[$cLastIdx]) && isset($cSlice[$cLastIdx]['total'])) {
                        $cUltimo = $cSlice[$cLastIdx]['total'];
                      }
                      $cPrevIdx  = max($cLastIdx - 1, 0);
                      $cAnterior = isset($cSlice[$cPrevIdx]['total']) ? $cSlice[$cPrevIdx]['total'] : 1;
                      if ($cAnterior <= 0) {
                        $porcC = 0;
                      } else {
                        $porcC = round((($cUltimo / $cAnterior) * 100) - 100);
                      }
                    @endphp
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $porcC >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                      {{ $porcC >= 0 ? '+' . $porcC . '%' : $porcC . '%' }}
                    </span>
                  </td>
                </tr>

                {{-- REGISTROS DE PROGRESO --}}
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">Registros de Progreso</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ number_format($stats['progresos_fisicos']['total'] ?? 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ number_format($stats['progresos_fisicos']['este_mes'] ?? 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                      $pSlice    = $stats['progresos_fisicos']['por_mes'] ?? [];
                      $pLastIdx  = count($pSlice) - 1;
                      $pUltimo   = 0;
                      if (isset($pSlice[$pLastIdx]) && isset($pSlice[$pLastIdx]['total'])) {
                        $pUltimo = $pSlice[$pLastIdx]['total'];
                      }
                      $pPrevIdx  = max($pLastIdx - 1, 0);
                      $pAnterior = isset($pSlice[$pPrevIdx]['total']) ? $pSlice[$pPrevIdx]['total'] : 1;
                      if ($pAnterior <= 0) {
                        $porcP = 0;
                      } else {
                        $porcP = round((($pUltimo / $pAnterior) * 100) - 100);
                      }
                    @endphp
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $porcP >= 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                      {{ $porcP >= 0 ? '+' . $porcP . '%' : $porcP . '%' }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const colors = {
        primary: '#10B981',   // verde
        secondary: '#3B82F6', // azul para mayor contraste
        success: '#10B981',
        danger: '#EF4444',
        warning: '#FBBF24',
        info: '#3B82F6',
        light: '#F3F4F6',
        dark: '#1F2937'
      };

      // Función para mostrar mensaje alternativo cuando no hay suficientes datos
      function showFallbackMessage(canvas, value, color, label) {
        canvas.parentNode.innerHTML = `
          <div class="flex flex-col items-center justify-center h-full">
            <span class="text-3xl font-bold text-${color}-600">${value}</span>
            <span class="text-sm text-gray-500">${label}</span>
          </div>
        `;
      }

      // ─────────────────────────────────────────────────────────────────────
      // 1) Gráfica de Distribución de Usuarios (Doughnut)
      const userDistributionCtx = document.getElementById('userDistributionChart')?.getContext('2d');
      if (userDistributionCtx) {
        new Chart(userDistributionCtx, {
          type: 'doughnut',
          data: {
            labels: ['Administradores', 'Nutriólogos', 'Pacientes'],
            datasets: [{
              data: [
                {{ $stats['usuarios']['admin'] ?? 0 }},
                {{ $stats['usuarios']['nutriologo'] ?? 0 }},
                {{ $stats['usuarios']['paciente'] ?? 0 }}
              ],
              // colores con mayor contraste
              backgroundColor: [colors.primary, colors.info, colors.warning],
              borderWidth: 0
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
              legend: {
                position: 'bottom',
                labels: {
                  padding: 20,
                  usePointStyle: true,
                  pointStyle: 'circle'
                }
              }
            }
          }
        });
      }

      // ─────────────────────────────────────────────────────────────────────
      // 2) Gráfica de Actividad Mensual
      const monthlyActivityCtx = document.getElementById('monthlyActivityChart')?.getContext('2d');
      const usuarioLabels = @json(array_column($stats['usuarios_por_mes'] ?? [], 'mes'));
      const usuarioTotals = @json(array_column($stats['usuarios_por_mes'] ?? [], 'total'));

      if (monthlyActivityCtx && usuarioLabels.length > 0) {
        new Chart(monthlyActivityCtx, {
          type: 'line',
          data: {
            labels: usuarioLabels,
            datasets: [
              {
                label: 'Usuarios nuevos',
                data: usuarioTotals,
                borderColor: colors.primary,
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.3,
                fill: true
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'top',
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                grid: {
                  drawBorder: false
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            }
          }
        });
      } else if (monthlyActivityCtx) {
        monthlyActivityCtx.canvas.parentNode.innerHTML = '<p class="text-center text-gray-500 mt-10">No hay datos de usuarios recientes.</p>';
      }

      // ─────────────────────────────────────────────────────────────────────
      // 3) Mini Charts de las tarjetas
      // ── 3.1) Usuarios Mini Chart
      const usersChartCanvas = document.getElementById('usersChart');
      if (usersChartCanvas) {
        const lastThreeUsuarioLabels = usuarioLabels.slice(-3);
        const lastThreeUsuariosData = usuarioTotals.slice(-3);

        if (lastThreeUsuarioLabels.length > 1 && lastThreeUsuariosData.length > 1) {
          new Chart(usersChartCanvas.getContext('2d'), {
            type: 'line',
            data: {
              labels: lastThreeUsuarioLabels,
              datasets: [{
                data: lastThreeUsuariosData,
                borderColor: colors.primary,
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 0
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false }
              },
              scales: {
                x: { display: false },
                y: { display: false }
              }
            }
          });
        } else {
          const currentMonthTotal = lastThreeUsuariosData[lastThreeUsuariosData.length - 1] || 0;
          showFallbackMessage(usersChartCanvas, currentMonthTotal, 'green', 'este mes');
        }
      }

      // ── 3.2) Citas Mini Chart
      const appointmentsChartCanvas = document.getElementById('appointmentsChart');
      const citasPorMesTotals = @json(array_column($stats['citas']['por_mes'] ?? [], 'total'));
      const citasPorMesLabels = @json(array_column($stats['citas']['por_mes'] ?? [], 'mes'));

      if (appointmentsChartCanvas) {
        const lastThreeCitasLabels = citasPorMesLabels.slice(-3);
        const lastThreeCitasData = citasPorMesTotals.slice(-3);

        if (lastThreeCitasLabels.length > 1 && lastThreeCitasData.length > 1) {
          new Chart(appointmentsChartCanvas.getContext('2d'), {
            type: 'line',
            data: {
              labels: lastThreeCitasLabels,
              datasets: [{
                data: lastThreeCitasData,
                borderColor: colors.warning,
                backgroundColor: 'rgba(251, 191, 36, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 0
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false }
              },
              scales: {
                x: { display: false },
                y: { display: false }
              }
            }
          });
        } else {
          const currentMonthTotal = {{ $stats['citas']['este_mes'] ?? 0 }};
          showFallbackMessage(appointmentsChartCanvas, currentMonthTotal, 'yellow', 'este mes');
        }
      }

      // ── 3.3) Progresos Mini Chart
      const progressChartCanvas = document.getElementById('progressChart');
      const progresosTotals = @json(array_column($stats['progresos_fisicos']['por_mes'] ?? [], 'total'));
      const progresosLabels = @json(array_column($stats['progresos_fisicos']['por_mes'] ?? [], 'mes'));

      if (progressChartCanvas) {
        const lastThreeProgresosLabels = progresosLabels.slice(-3);
        const lastThreeProgresosData = progresosTotals.slice(-3);

        if (lastThreeProgresosLabels.length > 1 && lastThreeProgresosData.length > 1) {
          new Chart(progressChartCanvas.getContext('2d'), {
            type: 'line',
            data: {
              labels: lastThreeProgresosLabels,
              datasets: [{
                data: lastThreeProgresosData,
                borderColor: colors.secondary,
                backgroundColor: 'rgba(52, 211, 153, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 0
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false }
              },
              scales: {
                x: { display: false },
                y: { display: false }
              }
            }
          });
        } else {
          const currentMonthTotal = {{ $stats['progresos_fisicos']['este_mes'] ?? 0 }};
          showFallbackMessage(progressChartCanvas, currentMonthTotal, 'teal', 'este mes');
        }
      }
    });
  </script>
</x-layouts.app>
