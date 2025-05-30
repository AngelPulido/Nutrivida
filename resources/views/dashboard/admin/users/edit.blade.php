<x-layouts.app title="Editar Usuario" metaDescription="Editar usuario">
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Editar usuario #{{ $user->id }}</h1>

        @if($errors->any())
          <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('dashboard.admin.users.update', $user->id) }}" method="POST" class="space-y-4">
          @csrf @method('PUT')

          <!-- Sección de datos básicos -->
          <div class="border-b border-gray-200 pb-4">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Datos básicos</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input type="email" name="correo" value="{{ old('correo', $user->correo) }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>Administrador</option>
                  <option value="nutriologo" {{ $user->rol === 'nutriologo' ? 'selected' : '' }}>Nutriólogo</option>
                  <option value="paciente" {{ $user->rol === 'paciente' ? 'selected' : '' }}>Paciente</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Nueva Contraseña (opcional)</label>
                <input type="password" name="contraseña"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>
            </div>
          </div>

          <!-- Sección de perfil -->
          <div class="pt-4">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Información del perfil</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="teléfono" value="{{ old('telefono', $perfil->telefono) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Edad</label>
                <input type="number" name="edad" value="{{ old('edad', $perfil->edad) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Género</label>
                <select name="género"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  <option value="">Seleccionar...</option>
                  <option value="masculino" {{ (old('genero', $perfil->genero) == 'masculino' ? 'selected' : '') }}>Masculino</option>
                  <option value="femenino" {{ (old('genero', $perfil->genero) == 'femenino' ? 'selected' : '') }}>Femenino</option>
                  <option value="otro" {{ (old('genero', $perfil->genero) == 'otro' ? 'selected' : '') }}>Otro</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" name="dirección" value="{{ old('direccion', $perfil->direccion) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Altura (cm)</label>
                <input type="number" step="0.01" name="altura_cm" value="{{ old('altura_cm', $perfil->altura_cm) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Peso (kg)</label>
                <input type="number" step="0.01" name="peso_kg" value="{{ old('peso_kg', $perfil->peso_kg) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div id="especialidad-field" class="{{ $user->rol === 'nutriologo' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700">Especialidad</label>
                <input type="text" name="especialidad" value="{{ old('especialidad', $perfil->especialidad) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>
            </div>
          </div>

          <div class="flex justify-end space-x-2 pt-4">
            <a href="{{ route('dashboard.admin.users.index') }}"
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Guardar cambios</button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <script>
    // Mostrar/ocultar campo de especialidad según el rol seleccionado
    document.querySelector('select[name="rol"]').addEventListener('change', function() {
      const especialidadField = document.getElementById('especialidad-field');
      if (this.value === 'nutriologo') {
        especialidadField.classList.remove('hidden');
      } else {
        especialidadField.classList.add('hidden');
      }
    });
  </script>
</x-layouts.app>