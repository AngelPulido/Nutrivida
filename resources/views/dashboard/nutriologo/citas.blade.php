<x-layouts.app title="Mis Citas" metaDescription="Gestión de citas del nutriólogo">
<div class="flex min-h-screen bg-gray-50">
    <aside class="w-64">
        <x-layouts.navNutriologo />
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">Gestión de Citas</h1>
                <p class="text-gray-600 mt-1">Listado de todas tus citas programadas</p>
            </div>

            @if(count($appointments) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-10 w-10 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($appointment['paciente_nombre'] ?? 'P') }}&background=random" 
                                         alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $appointment['paciente_nombre'] ?? 'Paciente' }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $appointment['paciente_id'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment['fecha'])->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appointment['fecha'])->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $appointment['estado'] === 'aprobada' ? 'bg-green-100 text-green-800' : 
                                       ($appointment['estado'] === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($appointment['estado']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $appointment['notas'] ?? 'Sin notas' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <select onchange="window.location.href='{{ route('nutriologo.citas.update', $appointment['id']) }}?estado='+this.value"
                                    class="border rounded p-1 text-sm focus:ring-teal-500 focus:border-teal-500">
                                    <option value="pendiente" {{ $appointment['estado'] === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="aprobada" {{ $appointment['estado'] === 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                                    <option value="cancelada" {{ $appointment['estado'] === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 text-center">
                <p class="text-gray-500">No tienes citas programadas</p>
                <a href="{{ route('nutriologo.citas.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Crear nueva cita
                </a>
            </div>
            @endif

            @if(count($appointments) > 0)
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-200">
                <p class="text-sm text-gray-500">Mostrando <span class="font-medium">{{ count($appointments) }}</span> citas</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Anterior
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Siguiente
                    </button>
                </div>
            </div>
            @endif
        </div>
    </main>
</div>
</x-layouts.app>