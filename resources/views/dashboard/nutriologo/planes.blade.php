<x-layouts.app title="Planes Nutricionales" metaDescription="Gestión de planes nutricionales">
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar Navigation -->
    <aside class="w-64">
        <x-layouts.navNutriologo />
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Planes Nutricionales</h1>
                    <p class="text-gray-600 mt-1">Listado de todos tus planes creados</p>
                </div>
                <a href="{{ route('nutriologo.planes.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear Nuevo Plan
                </a>
            </div>

            <!-- Plans Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($plans as $plan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $plan['titulo'] }}</div>
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $plan['descripcion'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" 
                                             src="https://ui-avatars.com/api/?name={{ urlencode($plan['paciente_nombre'] ?? 'N/A') }}&background=random" 
                                             alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $plan['paciente_nombre'] ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($plan['creado_en'])->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-4">
                                    <a href="{{ route('nutriologo.planes.show', $plan['id']) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                    <a href="{{ route('nutriologo.planes.edit', $plan['id']) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                <p class="text-sm text-gray-500">Mostrando <span class="font-medium">{{ count($plans) }}</span> planes</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Anterior
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
</x-layouts.app>