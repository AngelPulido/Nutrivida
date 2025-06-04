<x-layouts.app title="Login" metaDescription="Accede de forma segura a tu cuenta NutriVida...">
  <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-green-50 py-10">
    <div class="flex shadow-md">
      <div class="flex flex-wrap content-center justify-center rounded-l-md bg-white" style="width: 24rem; height: 32rem;">
        <div class="w-72">
          <h1 class="text-xl font-semibold text-green-800">Bienvenido de nuevo</h1>
          <small class="text-green-600">Por favor, ingresa tus datos</small>

          @if($errors->has('login'))
            <div class="mt-4 p-3 text-sm text-red-700 bg-red-100 rounded">
              {{ $errors->first('login') }}
            </div>
          @endif

          <form action="{{ route('login') }}" method="POST" class="mt-4" novalidate>
            @csrf

            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold text-green-700">Correo electrónico</label>
              <input
                type="email"
                name="correo"
                value="{{ old('correo') }}"
                required
                placeholder="Ingresa tu correo"
                class="block w-full rounded-md border border-green-300 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 py-1 px-1.5 text-gray-600"
              />
              @error('correo')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-3">
              <label class="mb-2 block text-xs font-semibold text-green-700">Contraseña</label>
              <input
                type="password"
                name="contraseña"
                required
                placeholder="*****"
                class="block w-full rounded-md border border-green-300 focus:border-green-600 focus:outline-none focus:ring-1 focus:ring-green-600 py-1 px-1.5 text-gray-600"
              />
              @error('contraseña')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-3 flex justify-end">
              <a href="#" class="text-xs font-semibold text-green-600 hover:text-green-800">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="mb-3">
              <button
                type="submit"
                class="mb-1.5 block w-full text-center text-white bg-green-600 hover:bg-green-700 px-2 py-1.5 rounded-md transition-colors"
              >
                Iniciar sesión
              </button>
            </div>

            <div class="text-center">
              <span class="text-xs text-green-600 font-semibold">¿No tienes una cuenta?</span>
              <a href="{{ route('register') }}" class="text-xs font-semibold text-green-600 hover:text-green-800">Registrarse</a>
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