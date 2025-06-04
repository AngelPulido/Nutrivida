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

          <!-- Foto de perfil -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto de perfil</label>
            <div class="flex items-center">
                <div class="inline-block h-24 w-24 overflow-hidden rounded-full bg-gray-100">
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
                </div>
                <div class="ml-4">
                    <input type="file"
                          name="avatar"
                          id="avatar"
                          class="block w-full text-sm text-gray-700
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                    @if(optional($user->perfil)->avatar)
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="remove_avatar" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">Eliminar foto actual</span>
                            </label>
                        </div>
                    @endif
                </div>
            </div>
          </div>

          <!-- Foto de portada -->
          <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto de portada</label>
            <div class="mt-1">
                @if(optional($user->perfil)->cover_photo)
                    <div class="mb-4">
                        <img src="{{ asset('storage/covers/' . $user->perfil->cover_photo) }}"
                            alt="Cover photo"
                            class="w-full h-48 object-cover rounded-lg">
                    </div>
                @endif
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                        </div>
                        <input id="cover_photo" name="cover_photo" type="file" class="hidden" />
                    </label>
                </div>
                @if(optional($user->perfil)->cover_photo)
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remove_cover_photo" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">Eliminar foto de portada actual</span>
                        </label>
                    </div>
                @endif
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

              {{-- Especialidad --}}
              <div class="sm:col-span-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad</label>
                <input type="text"
                       name="especialidad"
                       value="{{ old('especialidad', optional($user->perfil)->especialidad) }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              {{-- Dirección --}}
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
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</x-layouts.app>