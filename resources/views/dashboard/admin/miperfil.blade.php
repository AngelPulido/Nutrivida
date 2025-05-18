<!-- resources/views/dashboard/nutriologo/miperfil.blade.php -->
<x-layouts.app title="Perfil de Usuario" metaDescription="Perfil del usuario">
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar Navigation -->
    <aside class="w-64">
        <x-layouts.navAdmin />
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
                             alt="Foto de perfil">
                    @endif
                    <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-3 h-3 border-2 border-white"></span>
                </div>
                
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->nombre }}</h2>
                    <p class="text-gray-600">{{ $user->correo }}</p>
                    <p class="text-sm text-gray-500 mt-1">Registrado: {{ \Carbon\Carbon::parse($user->creado_en)->format('d \d\e F Y') }}</p>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Teléfono</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->telefono ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Edad</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->edad ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Género</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->genero ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <!-- Location Info -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Dirección</h3>
                            <p class="text-gray-800">{{ optional($user->perfil)->direccion ?? '-' }}</p>
                        </div>       
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Correo electrónico</h3>
                            <p class="text-gray-800">{{ $user->correo }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Last Update -->
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">Última actualización: {{ \Carbon\Carbon::parse(optional($user->perfil)->actualizado_en ?? $user->actualizado_en)->format('d \d\e F Y, H:i') }}</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <a href="{{ route('dashboard.admin.profile') }}"
                   class="px-5 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Editar perfil
                </a>
            </div>
        </div>
    </main>
</div>
</x-layouts.app>
