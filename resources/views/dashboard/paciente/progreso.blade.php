<x-layouts.app title="Mi Progreso Físico">
<div class="flex min-h-screen bg-gray-50">
    <aside class="w-64">
    <x-layouts.navPaciente />
    </aside>

    <main class="flex-1 p-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Mi Progreso Físico</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Formulario de registro -->
                <div class="border rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Registrar Progreso</h2>
                    
                    <form method="POST" action="{{ route('paciente.progreso.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                                <input type="number" step="0.1" name="peso_kg" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Registro</label>
                                <input type="date" name="fecha_registro" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">% Grasa Corporal</label>
                                <input type="number" step="0.1" name="grasa_corporal_pct" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">% Masa Muscular</label>
                                <input type="number" step="0.1" name="masa_muscular_pct" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Foto de Progreso (Opcional)</label>
                                <input type="file" name="foto_progreso" accept="image/*" class="mt-1 block w-full">
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                                Registrar Progreso
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Historial de progreso -->
                <div class="border rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Mi Evolución</h2>
                    
                    <!-- Gráfico o tabla de progreso -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-500 text-center">Aquí irá tu gráfico de progreso</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</x-layouts.app>