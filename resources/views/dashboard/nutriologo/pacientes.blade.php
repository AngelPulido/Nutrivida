<x-layouts.app title="Mis Pacientes" metaDescription="Listado de pacientes asignados">
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar Navigation -->
    <aside class="w-64">
        <x-layouts.navNutriologo />
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Mis Pacientes</h1>
                    <p class="text-gray-600 mt-1">Listado de todos tus pacientes asignados</p>
                </div>
            </div>

            <!-- Patients Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($patients as $patient)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-12 w-12">
                                <img class="h-12 w-12 rounded-full" 
                                     src="https://ui-avatars.com/api/?name={{ urlencode($patient['paciente_nombre']) }}&background=random" 
                                     alt="">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-800">{{ $patient['paciente_nombre'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $patient['paciente_correo'] }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Edad</p>
                                <p class="text-gray-800 font-medium">{{ $patient['edad'] ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Género</p>
                                <p class="text-gray-800 font-medium">{{ $patient['genero'] ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Teléfono</p>
                                <p class="text-gray-800 font-medium">{{ $patient['telefono'] ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">IMC</p>
                                <p class="text-gray-800 font-medium">
                                    @if(isset($patient['altura_cm']) && isset($patient['peso_kg']))
                                        {{ round($patient['peso_kg'] / (($patient['altura_cm']/100) ** 2), 1) }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-3 flex justify-end border-t border-gray-200">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            Ver historial completo →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
</x-layouts.app>