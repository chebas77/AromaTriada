@extends('recursos.app')

@section('title', "Detalle del Envío #$tracking->id_tracking")

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle del Envío #{{ $tracking->id_tracking }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
        <!-- Información General -->
        <div class="mb-6">
            <p class="mb-2"><strong>Origen:</strong> {{ $tracking->origen }}</p>
            <p class="mb-2"><strong>Destino:</strong> {{ $tracking->destino }}</p>
            <p class="mb-2"><strong>Fecha de Despacho:</strong> {{ $tracking->fecha_despacho ?? 'Pendiente' }}</p>
            <p class="mb-2"><strong>Fecha de Entrega:</strong> {{ $tracking->fecha_entrega ?? 'Pendiente' }}</p>
            <p class="mb-2"><strong>Hora Programada:</strong> {{ $tracking->hora_programada ?? 'Pendiente' }}</p>
        </div>

        <div class="relative w-full h-2 bg-gray-200 rounded-full mb-8">
    <!-- Línea de progreso -->
    <div class="absolute top-0 h-2 bg-blue-500 rounded-full" style="width: {{ $progressPercentage }}%;"></div>
    <!-- Puntos de progreso -->
    <div class="flex justify-between">
        @foreach ($estados as $index => $estado)
            <div class="relative text-center">
                <!-- Punto de progreso -->
                <div class="w-6 h-6 rounded-full mx-auto 
                    {{ $index <= array_search($tracking->estado_actual, $estados) ? 'bg-blue-500' : 'bg-gray-300' }}">
                </div>
                <!-- Etiqueta del estado -->
                <span class="text-xs mt-1 block 
                    {{ $estado == $tracking->estado_actual ? 'font-bold text-blue-600' : 'text-gray-500' }}">
                    {{ $estado }}
                </span>
            </div>
        @endforeach
    </div>
</div>

        <!-- Productos del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Productos del Pedido</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Producto</th>
                    <th class="border px-4 py-2 text-left">Cantidad</th>
                    <th class="border px-4 py-2 text-left">Tamaño</th>
                    <th class="border px-4 py-2 text-left">Dedicatoria</th>
                    <th class="border px-4 py-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $producto->producto->nombre }}</td>
                    <td class="border px-4 py-2">{{ $producto->cantidad }}</td>
                    <td class="border px-4 py-2">{{ $producto->tamaño ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $producto->dedicatoria ?? 'Sin dedicatoria' }}</td>
                    <td class="border px-4 py-2 text-right">${{ number_format($producto->precio_unitario, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Servicios del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Servicios del Pedido</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Servicio</th>
                    <th class="border px-4 py-2 text-left">Cantidad</th>
                    <th class="border px-4 py-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $servicio->servicio->nombre }}</td>
                    <td class="border px-4 py-2">{{ $servicio->cantidad }}</td>
                    <td class="border px-4 py-2 text-right">${{ number_format($servicio->precio_unitario, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total del Pedido -->
        <div class="mt-6 text-right">
            @php
                $totalProductos = $productos->sum(function ($producto) {
                    return $producto->cantidad * $producto->precio_unitario;
                });

                $totalServicios = $servicios->sum(function ($servicio) {
                    return $servicio->cantidad * $servicio->precio_unitario;
                });

                $totalPedido = $totalProductos + $totalServicios;
            @endphp
            <h2 class="text-xl font-bold text-red-600">Total del Pedido: ${{ number_format($totalPedido, 2) }}</h2>
        </div>

        <a href="{{ route('tracking.mostrar') }}" 
           class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition">
           Volver al Listado
        </a>
    </div>
</section>
@endsection
