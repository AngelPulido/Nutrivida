<x-layouts.app title="Login" metaDescription="Accede de forma segura a tu cuenta NutriVida...">
  <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
    <div class="flex shadow-md">
      <div class="flex flex-wrap content-center justify-center rounded-l-md bg-white" style="width: 24rem; height: 32rem;">
        <div class="w-72">
          <h1 class="text-xl font-semibold">Bienvenido de nuevo</h1>
          <small class="text-gray-400">Por favor, ingresa tus datos</small>

          @if($errors->has('login'))
            <div class="mt-4 p-3 text-sm text-red-700 bg-red-100 rounded">
              {{ $errors->first('login') }}
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST" class="mt-4" novalidate>
            @csrf

            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold">Correo electrónico</label>
              <input
                type="email"
                name="correo"
                value="{{ old('correo') }}"
                required
                placeholder="Ingresa tu correo"
                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500"
              />
              @error('correo')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold">Contraseña</label>
              <input
                type="password"
                name="contraseña"
                required
                placeholder="*****"
                class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500"
              />
              @error('contraseña')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-3 flex justify-end">
              <a href="#" class="text-xs font-semibold text-purple-700">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="mb-3">
              <button
                type="submit"
                class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md"
              >
                Iniciar sesión
              </button>
            </div>

            <div class="text-center">
              <span class="text-xs text-gray-400 font-semibold">¿No tienes una cuenta?</span>
              <a href="{{ route('register') }}" class="text-xs font-semibold text-purple-700">Registrarse</a>
            </div>
          </form>
        </div>
      </div>

      <div class="flex flex-wrap content-center justify-center rounded-r-md" style="width: 24rem; height: 32rem;">
        <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md"
             src="https://i.imgur.com/9l1A4OS.jpeg" alt="Login Image">
      </div>
    </div>
  </div>
</x-layouts.app>
