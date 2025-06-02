<!-- resources/views/dashboard/administrador/users/index.blade.php -->
<x-layouts.app title="Usuarios" metaDescription="Gestión de usuarios">
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64 h-screen">
    <x-layouts.navAdmin />
  </aside>
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Encabezado con efecto de gradiente -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
          <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Gestión de Usuarios</h1>
            <a href="{{ route('dashboard.admin.users.create') }}"
               class="px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-gray-100 font-medium flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Nuevo usuario
            </a>
          </div>
        </div>

        <!-- Barra de búsqueda y herramientas -->
        <div class="px-6 py-3 bg-gray-50 border-b flex justify-between items-center">
          <div class="relative w-64">
            <input type="text" placeholder="Buscar usuarios..." 
                   class="w-full pl-10 pr-4 py-2 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <button class="text-sm text-gray-600 hover:text-indigo-600 flex items-center">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
              </svg>
              Filtros
            </button>
            <a href="{{ route('admin.users.export') }}" 
              class="text-sm text-gray-600 hover:text-indigo-600 flex items-center">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
              </svg>
              Exportar a Excel
            </a>
          </div>
        </div>

        <!-- Tabla de usuarios -->
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th></th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($users as $user)
              <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    @if($user->perfil->avatar)
                      <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden">
                        <img src="{{ asset('storage/avatars/' . $user->perfil->avatar) }}" 
                            alt="Foto de {{ $user->nombre }}"
                            class="h-full w-full object-cover">
                      </div>
                    @else
                      <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-indigo-600 font-medium">{{ substr($user->nombre, 0, 1) }}</span>
                      </div>
                    @endif
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ $user->nombre }}</div>
                      <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->correo }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $user->rol == 'admin' ? 'bg-purple-100 text-purple-800' : 
                       ($user->rol == 'nutriologo' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                    {{ ucfirst($user->rol) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('dashboard.admin.users.show', $user->id) }}" 
                       class="text-gray-400 hover:text-indigo-600" title="Ver">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                      </svg>
                    </a>
                    <a href="{{ route('dashboard.admin.users.edit', $user->id) }}" 
                       class="text-gray-400 hover:text-green-600" title="Editar">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                    </a>
                    <form action="{{ route('dashboard.admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                      @csrf @method('DELETE')
                      <button type="submit" 
                              class="text-gray-400 hover:text-red-600"
                              title="Eliminar"
                              onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pie de tabla -->
        <!-- Pie de tabla con paginación dinámica -->
        <div class="px-6 py-3 bg-gray-50 border-t flex items-center justify-between">
          <div class="flex items-center space-x-2">
            {{-- Botón Anterior --}}
            @if ($users->onFirstPage())
              <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">Anterior</span>
            @else
              <a href="{{ $users->previousPageUrl() }}"
                class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded">
                Anterior
              </a>
            @endif

            {{-- Texto Página X de Y --}}
            <span class="text-sm text-gray-500">
              Página {{ $users->currentPage() }} de {{ $users->lastPage() }}
            </span>

            {{-- Botón Siguiente --}}
            @if ($users->hasMorePages())
              <a href="{{ $users->nextPageUrl() }}"
                class="px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded">
                Siguiente
              </a>
            @else
              <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">Siguiente</span>
            @endif
          </div>

          {{-- Texto “Mostrando X-Y de Z usuarios” --}}
          <div class="text-sm text-gray-500">
            @php
              $start = ($users->currentPage() - 1) * $users->perPage() + 1;
              $end   = min($users->currentPage() * $users->perPage(), $users->total());
            @endphp

            Mostrando {{ $start }}-{{ $end }} de {{ $users->total() }} usuarios
          </div>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>