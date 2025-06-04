{{-- resources/views/dashboard/admin/users/create.blade.php --}}
<x-layouts.app title="Nuevo Usuario" metaDescription="Crear nuevo usuario">
  <div class="min-h-screen bg-gray-50 flex">
    <aside class="w-64 bg-white shadow-sm"><x-layouts.navAdmin /></aside>

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
              <h1 class="text-2xl font-semibold text-gray-800">Crear nuevo usuario</h1>
              <p class="mt-1 text-sm text-gray-500">Complete la información requerida para registrar un nuevo usuario</p>
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

        {{-- Formulario de creación --}}
        <form action="{{ route('dashboard.admin.users.store') }}" method="POST" class="space-y-8">
          @csrf

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
                  <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
                </div>
                <div>
                  <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                  <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="rol" class="block text-sm font-medium text-gray-700">Rol *</label>
                  <select id="rol" name="rol" required
                          class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
                    <option value="">Seleccionar rol...</option>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="nutriologo" {{ old('rol') == 'nutriologo' ? 'selected' : '' }}>Nutriólogo</option>
                    <option value="paciente" {{ old('rol') == 'paciente' ? 'selected' : '' }}>Paciente</option>
                  </select>
                </div>
                <div>
                  <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña *</label>
                  <input type="password" name="contraseña" id="contraseña" required
                         class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2 px-3">
                  <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Botones de acción --}}
          <div class="flex justify-end space-x-4 pt-4">
            
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Crear usuario
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

</x-layouts.app>