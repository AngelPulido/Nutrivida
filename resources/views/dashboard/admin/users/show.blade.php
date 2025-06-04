{{-- resources/views/dashboard/admin/users/show.blade.php --}}
<x-layouts.app title="Detalle de Usuario" metaDescription="Ver usuario">
  <div class="min-h-screen bg-gray-50 flex">
    <aside class="w-64 bg-white shadow-sm"><x-layouts.navAdmin /></aside>

    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-4xl mx-auto space-y-8">
        {{-- Encabezado --}}
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <a href="{{ route('dashboard.admin.users.index') }}" class="text-gray-700 hover:text-gray-700 transition-colors mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </a>
            <div>
              <h1 class="text-2xl font-semibold text-gray-700">Usuario {{ $user->nombre }}</h1>
              <div class="mt-1 flex items-center space-x-2">
                <p class="mt-1 text-sm text-gray-700">Rol actual: <span class="capitalize font-medium text-indigo-600">{{ $user->rol }}</span></p>
              </div>
            </div>
          </div>
          
        </div>

        {{-- Datos básicos --}}
        <div class="bg-white rounded-lg shadow border border-gray-200">
          <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-700 flex items-center">
              
              Datos básicos
            </h2>
          </div>
          <div class="px-6 py-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <p class="text-sm font-medium text-gray-700">Nombre completo</p>
                <p class="mt-1 text-gray-700">{{ $user->nombre }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-700">Correo electrónico</p>
                <p class="mt-1 text-gray-700">{{ $user->correo }}</p>
              </div>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700">Fecha de registro</p>
              <p class="mt-1 text-gray-700">{{ \Carbon\Carbon::parse($user->creado_en)->isoFormat('LL') }}</p>
            </div>
          </div>
        </div>

        {{-- Información del perfil --}}
        <div class="bg-white rounded-lg shadow border border-gray-200">
          <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-700 flex items-center">
              Información del perfil
            </h2>
          </div>
          <div class="px-6 py-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div>
                <p class="text-sm font-medium text-gray-700">Teléfono</p>
                <p class="mt-1 text-gray-700">{{ $perfil->telefono ?? 'No especificado' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-700">Edad</p>
                <p class="mt-1 text-gray-700">{{ $perfil->edad ?? 'No especificada' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-700">Género</p>
                <p class="mt-1 text-gray-700">
                  @isset($perfil->genero)
                    {{ ucfirst($perfil->genero) }}
                  @else
                    No especificado
                  @endisset
                </p>
              </div>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-700">Dirección</p>
              <p class="mt-1 text-gray-700">{{ $perfil->direccion ?? 'No especificada' }}</p>
            </div>

            @if($user->rol === 'paciente')
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <p class="text-sm font-medium text-gray-700">Altura</p>
                  <p class="mt-1 text-gray-700">{{ $perfil->altura_cm ?? 'No especificada' }} cm</p>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-700">Peso</p>
                  <p class="mt-1 text-gray-700">{{ $perfil->peso_kg ?? 'No especificado' }} kg</p>
                </div>
              </div>
            @endif

            @if($user->rol === 'nutriologo')
              <div>
                <p class="text-sm font-medium text-gray-700">Especialidad</p>
                <p class="mt-1 text-gray-700">{{ $perfil->especialidad ?? 'No especificada' }}</p>
              </div>
            @endif
          </div>
        </div>
        
        <div class="flex justify-end space-x-4 pt-4">
          <a href="{{ route('dashboard.admin.users.edit', $user->id) }}"
             class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Editar usuario
          </a>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>