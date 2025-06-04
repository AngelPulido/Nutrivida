<x-layouts.app title="Perfil de Usuario" metaDescription="Perfil del usuario">
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar Navigation -->
    <aside class="w-64">
        <x-layouts.navNutriologo />
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Profile Header -->
            <div class="p-6 border-b border-gray-200 flex items-start">
                <div class="relative mr-6">
                    @if(optional($user->perfil)->avatar)
                        <img class="h-24 w-24 rounded-full object-cover border-2 border-indigo-100"
                             src="{{ asset('storage/avatars/' . $user->perfil->avatar) }}"
                             alt="Foto de perfil">
                    @else
                        <img class="h-24 w-24 rounded-full object-cover border-2 border-indigo-100"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->nombre) }}&background=indigo&color=fff"
                             alt="Foto de perfil">
                    @endif
                    <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-3 h-3 border-2 border-white"></span>
                </div>
                
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->nombre }}</h1>
                    <p class="text-gray-600">{{ $user->correo }}</p>
                    <div class="mt-2 flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            Nutriólogo
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Registrado: {{ \Carbon\Carbon::parse($user->creado_en)->format('d \d\e F Y') }}</p>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Teléfono</label>
                            <p class="mt-1 text-gray-800">{{ optional($user->perfil)->telefono ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Edad</label>
                            <p class="mt-1 text-gray-800">{{ optional($user->perfil)->edad ?? '-' }} años</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Género</label>
                            <p class="mt-1 text-gray-800">{{ optional($user->perfil)->genero ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <!-- Location Info -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dirección</label>
                            <p class="mt-1 text-gray-800">{{ optional($user->perfil)->direccion ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Especialidad</label>
                            <p class="mt-1 text-gray-800">{{ optional($user->perfil)->especialidad ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Correo electrónico</label>
                            <p class="mt-1 text-gray-800">{{ $user->correo }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Cover Photo -->
                @if(optional($user->perfil)->cover_photo)
                <div class="pt-4 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto de portada</label>
                    <img src="{{ asset('storage/covers/' . $user->perfil->cover_photo) }}" 
                         alt="Portada" 
                         class="w-full h-48 object-cover rounded-lg">
                </div>
                @endif
                
                <!-- Last Update -->
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500">Última actualización: {{ \Carbon\Carbon::parse(optional($user->perfil)->actualizado_en ?? $user->actualizado_en)->format('d \d\e F Y, H:i') }}</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <a href="{{ route('dashboard.nutriologo.profile') }}"
                   class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Editar perfil
                </a>
            </div>
        </div>
    </main>
</div>
</x-layouts.app>