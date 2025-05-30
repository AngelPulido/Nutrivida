<x-layouts.app title="Detalle de Usuario" metaDescription="Ver usuario">
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6">

        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-bold">Usuario #{{ $user->id }}</h1>
          <div class="flex space-x-2">
            <a href="{{ route('dashboard.admin.users.edit', $user->id) }}"
               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Editar</a>
            <a href="{{ route('dashboard.admin.users.index') }}"
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Volver</a>
          </div>
        </div>

        <div class="space-y-6">
          <!-- Sección de datos básicos -->
          <div class="border-b border-gray-200 pb-4">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Datos básicos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Nombre</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->nombre }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Correo</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->correo }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Rol</p>
                <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->rol) }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Creado</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->creado_en }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Actualizado</p>
                <p class="mt-1 text-sm text-gray-900">{{ $user->actualizado_en }}</p>
              </div>
            </div>
          </div>

          <!-- Sección de perfil -->
          <div class="pt-4">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Información del perfil</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">Teléfono</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->telefono ?? 'No especificado' }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Edad</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->edad ?? 'No especificada' }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Género</p>
                <p class="mt-1 text-sm text-gray-900">
                  @isset($perfil->genero)
                    {{ ucfirst($perfil->genero) }}
                  @else
                    No especificado
                  @endisset
                </p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Dirección</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->direccion ?? 'No especificada' }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Altura (cm)</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->altura_cm ?? 'No especificada' }}</p>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-500">Peso (kg)</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->peso_kg ?? 'No especificado' }}</p>
              </div>

              @if($user->rol === 'nutriologo')
              <div>
                <p class="text-sm font-medium text-gray-500">Especialidad</p>
                <p class="mt-1 text-sm text-gray-900">{{ $perfil->especialidad ?? 'No especificada' }}</p>
              </div>
              @endif
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
</x-layouts.app>