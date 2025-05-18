<!-- resources/views/dashboard/administrador/users/show.blade.php -->
<x-layouts.app title="Detalle de Usuario" metaDescription="Ver usuario">
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64"><x-layouts.navAdmin /></aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-md p-6">

        <h1 class="text-2xl font-bold mb-4">Usuario #{{ $user->id }}</h1>

        <div class="space-y-2">
          <p><strong>Nombre:</strong> {{ $user->nombre }}</p>
          <p><strong>Correo:</strong> {{ $user->correo }}</p>
          <p><strong>Rol:</strong> {{ ucfirst($user->rol) }}</p>
          <p><strong>Creado:</strong> {{ $user->creado_en }}</p>
          <p><strong>Actualizado:</strong> {{ $user->actualizado_en }}</p>
        </div>

        <div class="mt-6 flex space-x-2">
          <a href="{{ route('dashboard.admin.users.edit', $user->id) }}"
             class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Editar</a>
          <a href="{{ route('dashboard.admin.users.index') }}"
             class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Volver</a>
        </div>

      </div>
    </main>
  </div>
</x-layouts.app>
