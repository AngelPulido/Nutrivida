{{-- resources/views/dashboard/admin/users/edit.blade.php --}}
<x-layouts.app title="Editar Usuario" metaDescription="Editar usuario">
  <div class="min-h-screen bg-gray-50 flex">
    <aside class="w-64"><x-layouts.navAdmin /></aside>

    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-4xl mx-auto space-y-8">
        {{-- Encabezado --}}
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <a href="{{ route('dashboard.admin.users.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
              </svg>
            </a>
            <div>
              <h1 class="text-2xl font-semibold text-gray-800">Usuario {{ $user->nombre }}</h1>
              <div class="mt-1 flex items-center space-x-2">
                <p class="mt-1 text-sm text-gray-500">Rol actual: <span class="capitalize font-medium text-green-600">{{ $user->rol }}</span></p>
              </div>
            </div>
          </div>
        </div>

        {{-- Errores de validación --}}
        @if($errors->any())
          <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Hubo {{ $errors->count() }} error(es) al enviar</h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif

        {{-- Formulario de edición --}}
        <form action="{{ route('dashboard.admin.users.update', $user->id) }}" method="POST" class="space-y-8">
          @csrf @method('PUT')
          <input type="hidden" name="rol" value="{{ $user->rol }}">

          {{-- Datos básicos --}}
          <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-800">Datos básicos</h2>
              <p class="mt-1 text-sm text-gray-500">Información principal de la cuenta.</p>
            </div>
            <div class="px-6 py-6 space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                  <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $user->nombre) }}" required
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                </div>
                <div>
                  <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                  <input type="email" name="correo" id="correo" value="{{ old('correo', $user->correo) }}" required
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                </div>
              </div>
              <div>
                <label for="contraseña" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                <input type="password" name="contraseña" id="contraseña"
                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3"
                       placeholder="Dejar en blanco para no cambiar">
                <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
              </div>
            </div>
          </div>

          {{-- Información del perfil --}}
          <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-medium text-gray-800">Información del perfil</h2>
              <p class="mt-1 text-sm text-gray-500">Detalles personales.</p>
            </div>
            <div class="px-6 py-6 space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                  <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                  <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $perfil->telefono ?? '') }}"
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                </div>
                <div>
                  <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                  <input type="number" name="edad" id="edad" value="{{ old('edad', $perfil->edad ?? '') }}"
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                </div>
                <div>
                  <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                  <select id="genero" name="genero"
                          class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                    <option value="">Seleccionar...</option>
                    <option value="masculino" {{ (old('genero', $perfil->genero ?? '') == 'masculino' ? 'selected' : '') }}>Masculino</option>
                    <option value="femenino" {{ (old('genero', $perfil->genero ?? '') == 'femenino' ? 'selected' : '') }}>Femenino</option>
                    <option value="otro" {{ (old('genero', $perfil->genero ?? '') == 'otro' ? 'selected' : '') }}>Otro</option>
                  </select>
                </div>
              </div>

              <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $perfil->direccion ?? '') }}"
                       class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
              </div>

              @if($user->rol === 'paciente')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label for="altura_cm" class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <input type="number" step="0.01" name="altura_cm" id="altura_cm" value="{{ old('altura_cm', $perfil->altura_cm ?? '') }}"
                             class="w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-sm">cm</span>
                      </div>
                    </div>
                  </div>
                  <div>
                    <label for="peso_kg" class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <input type="number" step="0.01" name="peso_kg" id="peso_kg" value="{{ old('peso_kg', $perfil->peso_kg ?? '') }}"
                             class="w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-sm">kg</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              @if($user->rol === 'nutriologo')
                <div>
                  <label for="especialidad" class="block text-sm font-medium text-gray-700">Especialidad</label>
                  <input type="text" name="especialidad" id="especialidad" value="{{ old('especialidad', $perfil->especialidad ?? '') }}"
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm py-2 px-3">
                </div>
              @endif
            </div>
          </div>

          {{-- Botones de acción --}}
          <div class="flex justify-end space-x-4 pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</x-layouts.app>
