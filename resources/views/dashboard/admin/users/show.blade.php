<x-layouts.app title="Detalle de Usuario" metaDescription="Ver usuario">
  <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-5xl mx-auto">
        <!-- Header con acciones -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
          <div>
            <div class="flex items-center mb-2">
              <div class="mr-3 p-2 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div>
                <h1 class="text-3xl font-bold text-gray-800">Detalles del Usuario</h1>
                <p class="text-gray-500 font-medium">ID: #{{ $user->id }}</p>
              </div>
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <a href="{{ route('dashboard.admin.users.edit', $user->id) }}"
               class="flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-lg hover:from-indigo-600 hover:to-blue-700 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
              </svg>
              Editar Perfil
            </a>
            <a href="{{ route('dashboard.admin.users.index') }}"
               class="flex items-center justify-center px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-all shadow-sm hover:shadow-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
              </svg>
              Volver
            </a>
          </div>
        </div>

        <!-- Tarjeta principal -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
          <!-- Sección de datos básicos -->
          <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center mb-6">
              <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 mr-4 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h2 class="text-2xl font-bold text-gray-800">Información Básica</h2>
                <p class="text-gray-500">Datos principales del usuario</p>
              </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                  Nombre
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">{{ $user->nombre }}</p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                  Correo
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">{{ $user->correo }}</p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                  Rol
                </p>
                <div class="pl-4">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                    {{ ucfirst($user->rol) }}
                  </span>
                </div>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                  Creado
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                  </svg>
                  {{ \Carbon\Carbon::parse($user->creado_en)->isoFormat('LLLL') }}
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                  Actualizado
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                  </svg>
                  {{ \Carbon\Carbon::parse($user->actualizado_en)->isoFormat('LLLL') }}
                </p>
              </div>
            </div>
          </div>

          <!-- Sección de perfil -->
          <div class="p-8">
            <div class="flex items-center mb-6">
              <div class="p-3 rounded-xl bg-blue-100 text-blue-600 mr-4 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
              </div>
              <div>
                <h2 class="text-2xl font-bold text-gray-800">Detalles del Perfil</h2>
                <p class="text-gray-500">Información adicional del usuario</p>
              </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Teléfono
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                  </svg>
                  {{ $perfil->telefono ?? 'No especificado' }}
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Edad
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">
                  {{ $perfil->edad ?? 'No especificada' }}
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Género
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">
                  @isset($perfil->genero)
                    {{ ucfirst($perfil->genero) }}
                  @else
                    No especificado
                  @endisset
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Dirección
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4 flex items-start">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                  </svg>
                  <span>{{ $perfil->direccion ?? 'No especificada' }}</span>
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Altura (cm)
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">
                  {{ $perfil->altura_cm ?? 'No especificada' }}
                </p>
              </div>

              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Peso (kg)
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">
                  {{ $perfil->peso_kg ?? 'No especificado' }}
                </p>
              </div>

              @if($user->rol === 'nutriologo')
              <div class="space-y-2">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                  <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                  Especialidad
                </p>
                <p class="text-lg font-medium text-gray-800 pl-4">
                  {{ $perfil->especialidad ?? 'No especificada' }}
                </p>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>