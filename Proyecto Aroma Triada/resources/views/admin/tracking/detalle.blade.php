@extends('recursos.base_admin')
@section('title', "Detalle del Tracking #{$tracking->id_tracking}")

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle del Tracking #{{ $tracking->id_tracking }}</h1>
    
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <!-- Información del Tracking -->
        <p class="mb-4"><strong>ID Venta:</strong> {{ $tracking->id_venta }}</p>
        <p class="mb-4"><strong>Estado:</strong> {{ $tracking->estado_actual }}</p>
        <p class="mb-4"><strong>Origen:</strong> {{ $tracking->origen }}</p>
        <p class="mb-4"><strong>Destino:</strong> {{ $tracking->destino }}</p>
        <p class="mb-4"><strong>Fecha de Despacho:</strong> {{ $tracking->fecha_despacho ?? 'Pendiente' }}</p>
        <p class="mb-4"><strong>Fecha de Entrega:</strong> {{ $tracking->fecha_entrega ?? 'Pendiente' }}</p>
        <p class="mb-4"><strong>Hora Programada:</strong> {{ $tracking->hora_programada ?? 'Pendiente' }}</p>

        <!-- Productos Relacionados -->
        <h2 class="text-xl font-bold mt-8 mb-4">Productos del Pedido</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 text-left">Producto</th>
                    <th class="border p-2 text-left">Cantidad</th>
                    <th class="border p-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tracking->venta->detalles as $detalle)
                    @if($detalle->producto)
                    <tr>
                        <td class="border p-2">{{ $detalle->producto->nombre }}</td>
                        <td class="border p-2">{{ $detalle->cantidad }}</td>
                        <td class="border p-2">{{ number_format($detalle->precio_unitario, 2) }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Servicios Relacionados -->
        <h2 class="text-xl font-bold mt-8 mb-4">Servicios del Pedido</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 text-left">Servicio</th>
                    <th class="border p-2 text-left">Cantidad</th>
                    <th class="border p-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tracking->venta->detalles as $detalle)
                    @if($detalle->servicio)
                    <tr>
                        <td class="border p-2">{{ $detalle->servicio->nombre }}</td>
                        <td class="border p-2">{{ $detalle->cantidad }}</td>
                        <td class="border p-2">{{ $detalle->tamaño }}</td>
                        <td class="border p-2">{{ number_format($detalle->precio_unitario, 2) }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.tracking.index') }}" 
           class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition-colors">
           Volver al Listado
        </a>
    </div>
</section>
@endsection
