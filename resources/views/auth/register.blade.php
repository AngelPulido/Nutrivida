<x-layouts.app title="Registro" metaDescription="Crea una cuenta para acceder a tus planes, citas y funciones de NutriVida.">

    <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
  
      <div class="flex shadow-md">
  
        <!-- Imagen a la izquierda -->
        <div class="flex flex-wrap content-center justify-center rounded-l-md" style="width: 24rem; height: 38rem;">
          <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-l-md" src="https://i.imgur.com/9l1A4OS.jpeg" alt="Register Image">
        </div>
  
        <!-- Formulario a la derecha -->
        <div class="flex flex-wrap content-center justify-center rounded-r-md bg-white" style="width: 24rem; height: 38rem;">
          <div class="w-72">
  
            <!-- Encabezado -->
            <h1 class="text-xl font-semibold">Crear cuenta</h1>
            <small class="text-gray-400">Completa los siguientes campos</small>

            {{-- Mensajes de error o éxito --}}
            @if($errors->has('register'))
              <div class="mt-4 p-3 text-sm text-red-700 bg-red-100 rounded">
                {{ $errors->first('register') }}
              </div>
            @endif
            @if(session('success'))
              <div class="mt-4 p-3 text-sm text-green-700 bg-green-100 rounded">
                {{ session('success') }}
              </div>
            @endif
  
            <!-- Formulario -->
            <form action="{{ route('register') }}" method="POST" class="mt-4" novalidate>
              @csrf
  
              <div class="mb-3">
                <label class="mb-2 block text-xs font-semibold">Nombre completo</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required placeholder="Ingresa tu nombre"
                       class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                @error('nombre')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
  
              <div class="mb-3">
                <label class="mb-2 block text-xs font-semibold">Correo electrónico</label>
                <input type="email" name="correo" value="{{ old('correo') }}" required placeholder="ejemplo@correo.com"
                       class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                @error('correo')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
  
              <div class="mb-3">
                <label class="mb-2 block text-xs font-semibold">Contraseña</label>
                <input type="password" name="contraseña" required placeholder="********"
                       class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                @error('contraseña')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
  
              <div class="mb-3">
                <label class="mb-2 block text-xs font-semibold">Rol</label>
                <select name="rol" required
                        class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1.5 px-2 text-gray-500">
                  <option value="">Selecciona un rol</option>
                  <option value="paciente" {{ old('rol')=='paciente' ? 'selected' : '' }}>Paciente</option>
                  <option value="nutriologo" {{ old('rol')=='nutriologo' ? 'selected' : '' }}>Nutriólogo</option>
                </select>
                @error('rol')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
              </div>
  
              <div class="mb-3">
                <button type="submit"
                        class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md">
                  Registrarse
                </button>
              </div>
  
              <!-- Footer -->
              <div class="text-center">
                <span class="text-xs text-gray-400 font-semibold">¿Ya tienes una cuenta?</span>
                <a href="{{ route('login.form') }}" class="text-xs font-semibold text-purple-700">Iniciar sesión</a>
              </div>
            </form>
  
          </div>
        </div>
  
      </div>
  
    </div>
  </x-layouts.app>