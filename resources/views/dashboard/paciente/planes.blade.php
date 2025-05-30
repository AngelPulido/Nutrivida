<x-layouts.app title="Mis Planes Nutricionales">
<div class="flex min-h-screen bg-gray-50">
    <aside class="w-64">
    <x-layouts.navPaciente />
    </aside>

    <main class="flex-1 p-8">
        <div class="max-w-7xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Mis Planes Nutricionales</h1>
            
            @if(count($planes) > 0)
            <div class="space-y-6">
                @foreach($planes as $plan)
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg">{{ $plan['titulo'] ?? 'Plan Nutricional' }}</h3>
                    <p class="text-gray-600 mt-2">{{ $plan['descripcion'] ?? '' }}</p>
                    
                    @if(isset($plan['dias']))
                    <div class="mt-4">
                        <h4 class="font-medium">Detalles por día:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-7 gap-2 mt-2">
                            @foreach($plan['dias'] as $dia)
                            <div class="border p-2 rounded">
                                <p class="font-medium">Día {{ $loop->iteration }}</p>
                                <p class="text-sm">{{ $dia['comidas'] ?? '' }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500">No tienes planes nutricionales asignados.</p>
            @endif
        </div>
    </main>
</div>
</x-layouts.app>