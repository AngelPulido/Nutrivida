<x-layouts.app title="Estadísticas" metaDescription="Estadísticas del sistema">
  @push('styles')
    <style>
      .chart-container {
        position: relative;
        height: 300px;
      }
    </style>
  @endpush

  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-7xl mx-auto">
        <!-- Encabezado -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4 rounded-lg mb-6">
          <h1 class="text-2xl font-bold text-white">Estadísticas del Sistema</h1>
        </div>

        <!-- Tarjetas Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Total Usuarios</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ number_format($stats['usuarios']['total']) }}</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Citas este Mes</h3>
            <p class="text-3xl font-bold text-blue-600">{{ number_format($stats['citas']['este_mes']) }}</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Mensajes</h3>
            <p class="text-3xl font-bold text-green-600">{{ number_format($stats['mensajes']) }}</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Progresos</h3>
            <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['progresos_fisicos']['total']) }}</p>
          </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Distribución de Usuarios</h3>
            <div class="chart-container">
              <canvas id="usuariosChart"></canvas>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Actividad Mensual</h3>
            <div class="chart-container">
              <canvas id="actividadChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Tabla de Datos -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Resumen Completo</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Administradores</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['usuarios']['admin']) }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Nutriólogos</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['usuarios']['nutriologo']) }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Pacientes</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['usuarios']['paciente']) }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Perfiles Completados</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['perfiles']) }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Citas Totales</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['citas']['total']) }}</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Progresos este Mes</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($stats['progresos_fisicos']['este_mes']) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de distribución de usuarios
        const usuariosCtx = document.getElementById('usuariosChart').getContext('2d');
        new Chart(usuariosCtx, {
          type: 'doughnut',
          data: {
            labels: @json($chartData['usuarios']['labels']),
            datasets: [{
              data: @json($chartData['usuarios']['data']),
              backgroundColor: @json($chartData['usuarios']['colors']),
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom'
              }
            }
          }
        });

        // Gráfico de actividad mensual
        const actividadCtx = document.getElementById('actividadChart').getContext('2d');
        new Chart(actividadCtx, {
          type: 'bar',
          data: {
            labels: @json($chartData['actividad']['labels']),
            datasets: [{
              label: 'Este Mes',
              data: @json($chartData['actividad']['data']),
              backgroundColor: @json($chartData['actividad']['colors']),
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: {
                beginAtZero: true
              }
            },
            plugins: {
              legend: {
                display: false
              }
            }
          }
        });
      });
    </script>
  @endpush
</x-layouts.app>