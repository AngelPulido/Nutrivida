{{-- resources/views/dashboard/admin/users/show.blade.php --}}
<x-layouts.app title="Detalle de Usuario" metaDescription="Ver usuario">
  <div class="min-h-screen bg-gradient-to-br from-green-50 to-teal-50 flex">
    <aside class="w-64 bg-white shadow-sm"><x-layouts.navAdmin /></aside>

    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-4xl mx-auto space-y-8">
        {{-- Encabezado --}}
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <a href="{{ route('dashboard.admin.users.index') }}" class="text-teal-600 hover:text-teal-800 transition-colors duration-200 mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </a>
            <div>
              <h1 class="text-2xl font-semibold text-gray-800">Detalles de <span class="text-teal-700">{{ $user->nombre }}</span></h1>
              <div class="mt-1 flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800 capitalize">
                  {{ $user->rol }}
                </span>
                <p class="text-sm text-gray-600">Registrado el {{ \Carbon\Carbon::parse($user->creado_en)->isoFormat('LL') }}</p>
              </div>
            </div>
          </div>
        </div>

        {{-- Datos básicos --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-6 py-4 bg-gradient-to-r from-teal-50 to-green-50 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
              <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Información básica
            </h2>
          </div>
          <div class="px-6 py-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Nombre completo</p>
                <p class="text-gray-800 font-medium">{{ $user->nombre }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Correo electrónico</p>
                <p class="text-gray-800 font-medium">{{ $user->correo }}</p>
              </div>
            </div>
            <div class="space-y-1">
              <p class="text-sm font-medium text-gray-600">Estado de la cuenta</p>
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Activa
              </span>
            </div>
          </div>
        </div>

        {{-- Información del perfil --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="px-6 py-4 bg-gradient-to-r from-teal-50 to-green-50 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
              <svg class="w-5 h-5 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              Detalles del perfil
            </h2>
          </div>
          <div class="px-6 py-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Teléfono</p>
                <p class="text-gray-800">{{ $perfil->telefono ?? '--' }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Edad</p>
                <p class="text-gray-800">{{ $perfil->edad ?? '--' }}</p>
              </div>
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Género</p>
                <p class="text-gray-800">
                  @isset($perfil->genero)
                    {{ ucfirst($perfil->genero) }}
                  @else
                    --
                  @endisset
                </p>
              </div>
            </div>
            
            <div class="space-y-1">
              <p class="text-sm font-medium text-gray-600">Dirección</p>
              <p class="text-gray-800">{{ $perfil->direccion ?? '--' }}</p>
            </div>

            @if($user->rol === 'paciente')
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                  <p class="text-sm font-medium text-gray-600">Altura</p>
                  <p class="text-gray-800">{{ $perfil->altura_cm ?? '--' }} cm</p>
                </div>
                <div class="space-y-1">
                  <p class="text-sm font-medium text-gray-600">Peso</p>
                  <p class="text-gray-800">{{ $perfil->peso_kg ?? '--' }} kg</p>
                </div>
              </div>
            @endif

            @if($user->rol === 'nutriologo')
              <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600">Especialidad</p>
                <p class="text-gray-800">{{ $perfil->especialidad ?? '--' }}</p>
              </div>
            @endif
          </div>
        </div>
        
        <div class="flex justify-end space-x-4 pt-4">
          <a href="{{ route('dashboard.admin.users.edit', $user->id) }}"
             class="px-4 py-2 bg-gradient-to-r from-teal-600 to-green-600 text-white rounded-lg hover:from-teal-700 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Editar usuario
          </a>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>