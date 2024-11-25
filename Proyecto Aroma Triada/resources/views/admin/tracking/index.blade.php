@extends('recursos.base_admin')
@section('title', 'Gestión de Tracking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Gestión de Tracking</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario de búsqueda por ID Tracking --}}
    <form action="{{ route('admin.tracking.index') }}" method="GET" class="mb-6">
        <div class="flex space-x-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Buscar por ID Tracking" 
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                Buscar
            </button>
            <a href="{{ route('admin.tracking.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none">
                Restablecer
            </a>
        </div>
    </form>

    {{-- Tabla de Tracking --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">ID Tracking</th>
                    <th class="px-4 py-2 border">ID Venta</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Origen</th>
                    <th class="px-4 py-2 border">Destino</th>
                    <th class="px-4 py-2 border">Fecha Despacho</th>
                    <th class="px-4 py-2 border">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trackings as $tracking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $tracking->id_tracking }}</td>
                        <td class="px-4 py-2 border">{{ $tracking->id_venta }}</td>
                        <td class="px-4 py-2 border">{{ $tracking->estado_actual }}</td>
                        <td class="px-4 py-2 border">{{ $tracking->origen }}</td>
                        <td class="px-4 py-2 border">{{ $tracking->destino }}</td>
                        <td class="px-4 py-2 border">{{ $tracking->fecha_despacho ?? 'No definida' }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('admin.tracking.show', $tracking->id_tracking) }}" 
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Gestionar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $trackings->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
