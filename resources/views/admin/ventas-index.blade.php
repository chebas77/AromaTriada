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
        <!-- Filtro por nombre de usuario -->
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Buscar por nombre de usuario" 
            class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
        >

        <!-- Filtro por fecha de inicio -->
        <input 
            type="date" 
            name="fecha_inicio" 
            value="{{ request('fecha_inicio') }}" 
            class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
        >

        <!-- Filtro por fecha de fin -->
        <input 
            type="date" 
            name="fecha_fin" 
            value="{{ request('fecha_fin') }}" 
            class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
        >

        <!-- Filtro por estado -->
        <select 
            name="estado" 
            class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
        >
            <option value="">Filtrar por estado</option>
            <option value="En proceso" {{ request('estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="Enviado" {{ request('estado') == 'Enviado' ? 'selected' : '' }}>Enviado</option>
            <option value="Entregado" {{ request('estado') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="Cancelado" {{ request('estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>

        <!-- Filtro por método de entrega -->
        <select 
            name="metodo_entrega" 
            class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500"
        >
            <option value="">Filtrar por método de entrega</option>
            <option value="Delivery" {{ request('metodo_entrega') == 'Delivery' ? 'selected' : '' }}>Delivery</option>
            <option value="Recojo en tienda" {{ request('metodo_entrega') == 'Recojo en tienda' ? 'selected' : '' }}>Recojo en tienda</option>
        </select>

        <!-- Botón de búsqueda -->
        <button 
            type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
            Buscar
        </button>

        <!-- Botón para restablecer filtros -->
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
        {{ $ventas->appends([
            'search' => request('search'),
            'fecha_inicio' => request('fecha_inicio'),
            'fecha_fin' => request('fecha_fin'),
            'estado' => request('estado'),
            'metodo_entrega' => request('metodo_entrega'),
        ])->links() }}
    </div>
</div>

{{-- Botón para regresar --}}
<div class="mt-6 text-center">
    <a href="{{ route('admin.index') }}" 
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
        Regresar
    </a>
</div>
<div class="text-right mb-4">
    <button 
        type="button" 
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none"
        onclick="document.getElementById('pdfModal').classList.remove('hidden')">
        Configurar PDF
    </button>
</div>
<!-- Modal -->
<div id="pdfModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-1/2 rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold mb-4">Configurar PDF</h2>
        
        <form action="{{ route('admin.generarPDF') }}" target="_blank" method="POST">
            @csrf
            {{-- Selección de rango de tiempo --}}
            <div class="mb-4">
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="mt-1 block w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="mt-1 block w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500">
            </div>
            
            {{-- Selección de columnas --}}
            <div class="mb-4">
                <label for="columnas" class="block text-sm font-medium text-gray-700">Seleccionar columnas</label>
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <label><input type="checkbox" name="columnas[]" value="ID Venta" checked> ID Venta</label>
                    <label><input type="checkbox" name="columnas[]" value="Usuario" checked> Usuario</label>
                    <label><input type="checkbox" name="columnas[]" value="Total" checked> Total</label>
                    <label><input type="checkbox" name="columnas[]" value="Fecha" checked> Fecha</label>
                    <label><input type="checkbox" name="columnas[]" value="Estado" checked> Estado</label>
                    <label><input type="checkbox" name="columnas[]" value="Metodo Pago"> Método Pago</label>
                    <label><input type="checkbox" name="columnas[]" value="Metodo Entrega"> Método Entrega</label>
                    <label><input type="checkbox" name="columnas[]" value="Direccion Entrega"> Dirección Entrega</label>
                </div>
            </div>
            
            {{-- Botones del modal --}}
            <div class="flex justify-end space-x-4">
                <button 
                    type="button" 
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none"
                    onclick="document.getElementById('pdfModal').classList.add('hidden')">
                    Cancelar
                </button>
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">
                    Generar PDF
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
