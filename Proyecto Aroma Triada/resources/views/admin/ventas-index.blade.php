@extends('recursos.base_admin')
@section('title', 'Gestión de Ventas')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Gestión de Ventas</h1>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario de búsqueda --}}
    <form action="{{ route('admin.verPedidos') }}" method="GET" class="mb-6">
        <div class="flex space-x-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Buscar por nombre de usuario" 
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                Buscar
            </button>
            <a 
                href="{{ route('admin.verPedidos') }}" 
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none">
                Restablecer
            </a>
        </div>
    </form>

    {{-- Tabla de ventas --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">ID Venta</th>
                    <th class="px-4 py-2 border">Usuario</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Metodo Pago</th>
                    <th class="px-4 py-2 border">Metodo Entrega</th>
                    <th class="px-4 py-2 border">Direccion Entrega</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    @php
                        // Asignar clases dinámicamente según el estado
                        $rowClass = match($venta->estado) {
                            'En proceso' => 'bg-yellow-100',
                            'Enviado' => 'bg-blue-100',
                            'Entregado' => 'bg-green-100',
                            'Cancelado' => 'bg-red-100',
                            default => '',
                        };
                    @endphp
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('admin.ventas.detalle', $venta->id_pedido) }}'">
    <td class="px-4 py-2 border">{{ $venta->id_pedido }}</td>
    <td class="px-4 py-2 border">{{ $venta->usuario->name ?? 'N/A' }}</td>
    <td class="px-4 py-2 border">{{ number_format($venta->total, 2) }}</td>
    <td class="px-4 py-2 border">{{ $venta->fecha->format('d/m/Y') }}</td>
    <td class="px-4 py-2 border">{{ $venta->estado }}</td>
    <td class="px-4 py-2 border">{{ $venta->metodo_pago }}</td>
    <td class="px-4 py-2 border">{{ $venta->metodo_entrega }}</td>
    <td class="px-4 py-2 border">{{ $venta->direccion_entrega }}</td>
</tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $ventas->appends(['search' => request('search')])->links() }}
    </div>
</div>

{{-- Botón para regresar --}}
<div class="mt-6 text-center">
    <a href="{{ route('admin.index') }}" 
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
        Regresar
    </a>
</div>
@endsection
