<!-- resources/views/dashboard/administrador/users/create.blade.php -->
<x-layouts.app title="Nuevo Usuario" metaDescription="Crear usuario">
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Crear nuevo usuario</h1>

        @if($errors->any())
          <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('dashboard.admin.users.store') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input name="nombre" value="{{ old('nombre') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Correo</label>
            <input type="email" name="correo" value="{{ old('correo') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Rol</label>
            <select name="rol" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
              <option value="admin">Administrador</option>
              <option value="nutriologo">Nutriólogo</option>
              <option value="paciente">Paciente</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
          </div>

          <div class="flex justify-end space-x-2">
            <a href="{{ route('dashboard.admin.users.index') }}"
               class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Guardar</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</x-layouts.app>
