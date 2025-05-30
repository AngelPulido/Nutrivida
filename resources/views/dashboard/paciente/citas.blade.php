<x-layouts.app title="Mis Citas">
<div class="flex min-h-screen bg-gray-50">
    <aside class="w-64">
        <x-layouts.navPaciente />
    </aside>

    <main class="flex-1 p-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Mis Citas Programadas</h1>
                <button x-data x-on:click="$dispatch('open-modal')" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Solicitar Nueva Cita
                </button>
            </div>
            
            @if(count($citas) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nutriólogo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($citas as $cita)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $cita['nutriologo'] ?? 'Nutriólogo' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($cita['fecha'])->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    {{ $cita['estado'] === 'aprobada' ? 'bg-green-100 text-green-800' : 
                                       ($cita['estado'] === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($cita['estado']) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-500">No tienes citas programadas.</p>
            @endif
        </div>

        <!-- Modal para nueva cita -->
        <x-modal name="solicitar-cita">
            <form method="POST" action="{{ route('paciente.citas.store') }}" class="p-6">
                @csrf
                <h2 class="text-lg font-medium mb-4">Solicitar Nueva Cita</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nutriólogo</label>
                        <select name="nutriologo_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <!-- Opciones de nutriólogos -->
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notas (Opcional)</label>
                        <textarea name="notas" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border rounded-md">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Solicitar Cita
                    </button>
                </div>
            </form>
        </x-modal>
    </main>
</div>
</x-layouts.app>