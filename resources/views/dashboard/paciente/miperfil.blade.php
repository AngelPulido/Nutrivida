<!-- resources/views/dashboard/paciente/miperfil.blade.php -->
<x-layouts.app title="Perfil de Usuario" metaDescription="Perfil del usuario">
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar Navigation -->
    <aside class="w-64">
        <x-layouts.navPaciente />
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Profile Header -->
            <div class="p-6 border-b border-gray-200 flex items-start">
                <div class="relative mr-6">
                    @if(optional($user->perfil)->avatar)
                        <img class="h-20 w-20 rounded-full object-cover border-2 border-indigo-100"
                             src="{{ asset('storage/avatars/' . $user->perfil->avatar) }}"
                             alt="Foto de perfil">
                    @else
                        <img class="h-20 w-20 rounded-full object-cover border-2 border-indigo-100"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre) }}&background=indigo&color=fff"
                             alt="Avatar generado">
                    @endif
                    <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-3 h-3 border-2 border-white"></span>
                </div>
                
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->nombre }}</h2>
                    <p class="text-gray-600">{{ ucfirst($user->rol) }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        Miembro desde: {{ \Carbon\Carbon::parse($user->creado_en)->format('F Y') }}
                    </p>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Teléfono</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->telefono ?? '—' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Edad</h3>
                            <p class="text-gray-800">
                                @if(optional($user->perfil)->edad) 
                                    {{ optional($user->perfil)->edad }} años
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Género</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->genero ?? '—' }}</p>
                        </div>
                    </div>
                    
                    <!-- Location & Specialty -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Dirección</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->direccion ?? '—' }}</p>
                        </div>            
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Correo electrónico</h3>
                            <p class="text-gray-800">{{ $user->correo }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Health Metrics -->
                <div class="pt-4 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Medidas corporales</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-indigo-50 p-4 rounded-lg text-center">
                            <h4 class="text-xs font-medium text-indigo-600">ALTURA</h4>
                            <p class="text-2xl font-bold text-gray-800">
                                @if(optional($user->perfil)->altura_cm)
                                    {{ optional($user->perfil)->altura_cm }}<span class="text-sm">cm</span>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                        <div class="bg-indigo-50 p-4 rounded-lg text-center">
                            <h4 class="text-xs font-medium text-indigo-600">PESO</h4>
                            <p class="text-2xl font-bold text-gray-800">
                                @if(optional($user->perfil)->peso_kg)
                                    {{ optional($user->perfil)->peso_kg }}<span class="text-sm">kg</span>
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                        <div class="bg-indigo-50 p-4 rounded-lg text-center">
                            <h4 class="text-xs font-medium text-indigo-600">IMC</h4>
                            <p class="text-2xl font-bold text-gray-800">
                                @php
                                    $h = optional($user->perfil)->altura_cm / 100;
                                    $w = optional($user->perfil)->peso_kg;
                                @endphp
                                @if($h && $w)
                                    {{ number_format($w / ($h * $h), 1) }}
                                @else
                                    —
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Last Update -->
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Última actualización: 
                        {{ \Carbon\Carbon::parse(optional($user->perfil)->actualizado_en ?? $user->actualizado_en)
                            ->format('d \d\e F Y, H:i') }}
                    </p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <a href="{{ route('dashboard.paciente.profile') }}"
                   class="px-5 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Editar perfil
                </a>
            </div>
        </div>
    </main>
</div>
</x-layouts.app>
