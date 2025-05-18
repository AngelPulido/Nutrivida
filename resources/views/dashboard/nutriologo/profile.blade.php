<x-layouts.app title="Perfil de Usuario" metaDescription="Actualiza tu información de perfil en NutriVida">
  <div class="flex min-h-screen bg-gray-50">
    {{-- NAV IZQUIERDO --}}
    <aside class="w-64">
      <x-layouts.navNutriologo />
    </aside>

    {{-- FORMULARIO A LA DERECHA --}}
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <div class="mb-6">
          <h1 class="text-2xl font-bold text-gray-800">NutriVida</h1>
          <p class="text-gray-600">Actualiza tu información de perfil</p>
        </div>

        {{-- Mensajes de error o éxito --}}
        @if($errors->any())
          <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if(session('success'))
          <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('dashboard.nutriologo.profile.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
          @csrf
          @method('PUT')

          {{-- Sección de Fotos --}}
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Foto de perfil</label>
              <div class="flex items-center">
                <span class="inline-block h-16 w-16 overflow-hidden rounded-full bg-gray-100">
                  @if(optional($user->perfil)->avatar)
                    <img src="{{ asset('storage/avatars/' . $user->perfil->avatar) }}"
                         alt="Avatar"
                         class="h-full w-full object-cover">
                  @else
                    <svg class="h-full w-full text-gray-300"
                         fill="currentColor"
                         viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  @endif
                </span>
                <input type="file"
                       name="avatar"
                       class="ml-4 text-sm text-gray-700">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Foto de portada</label>
              <div class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 py-10">
                <div class="text-center">
                  @if(optional($user->perfil)->cover_photo)
                    <img src="{{ asset('storage/covers/' . $user->perfil->cover_photo) }}"
                         alt="Cover"
                         class="w-full h-32 object-cover rounded-md mb-2">
                  @endif
                  <label class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">
                    <span>Subir archivo</span>
                    <input type="file"
                           name="cover_photo"
                           class="sr-only">
                  </label>
                  <p class="pl-1 text-sm text-gray-600">PNG, JPG, GIF hasta 10MB</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Información Personal --}}
          <div class="pt-6 border-t border-gray-200">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h2>
            <div class="grid grid-cols-1 gap-y-4 gap-x-6 sm:grid-cols-6">
              {{-- Nombre --}}
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                <input type="text"
                       name="nombre"
                       value="{{ old('nombre', $user->nombre) }}"
                       required
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>
              {{-- Teléfono --}}
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Número de teléfono</label>
                <input type="tel"
                       name="telefono"
                       pattern="[0-9]*"
                       value="{{ old('telefono', optional($user->perfil)->telefono) }}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              {{-- Edad --}}
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Edad</label>
                <input type="number"
                       name="edad"
                       value="{{ old('edad', optional($user->perfil)->edad) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              {{-- Género --}}
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Género</label>
                <select name="genero"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  <option value="Masculino" {{ old('genero', optional($user->perfil)->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                  <option value="Femenino" {{ old('genero', optional($user->perfil)->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                  <option value="Otro" {{ old('genero', optional($user->perfil)->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
              </div>

              {{-- Dirección --}}
               <div class="sm:col-span-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                <input type="text"
                       name="especialidad"
                       value="{{ old('especialidad', optional($user->perfil)->especialidad) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="sm:col-span-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                <input type="text"
                       name="direccion"
                       value="{{ old('direccion', optional($user->perfil)->direccion) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>
            </div>
          </div>

          {{-- Botones de acción --}}
          <div class="pt-6 border-t border-gray-200 flex justify-end space-x-3">
            <a href="#" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              Cancelar
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</x-layouts.app>
