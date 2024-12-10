@extends('recursos.base_admin')

@section('title', 'Detalle de la Venta')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Detalle de la Venta #{{ $venta->id_pedido }}</h1>

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <!-- Información General -->
        <p class="mb-4"><strong>Usuario:</strong> {{ $venta->usuario->name ?? 'N/A' }}</p>
        <p class="mb-4"><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y') }}</p>
        <p class="mb-4"><strong>Total:</strong> S/ {{ number_format($venta->total, 2) }}</p>
        <p class="mb-4"><strong>Método de Pago:</strong> {{ $venta->metodo_pago }}</p>
        <p class="mb-4"><strong>Método de Entrega:</strong> {{ $venta->metodo_entrega }}</p>
        <p class="mb-4"><strong>Dirección de Entrega:</strong> {{ $venta->direccion_entrega }}</p>

        <!-- Productos del Pedido -->
        <h2 class="text-xl font-bold mt-8 mb-4">Productos del Pedido</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2 text-left">Producto</th>
                    <th class="border p-2 text-left">Cantidad</th>
                    <th class="border p-2 text-left">Tamaño</th>
                    <th class="border p-2 text-left">Dedicatoria</th>
                    <th class="border p-2 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                    @if ($detalle->producto)
                        <tr>
                            <td class="border p-2">{{ $detalle->producto->nombre }}</td>
                            <td class="border p-2">{{ $detalle->cantidad }}</td>
                            <td class="border p-2">{{ $detalle->tamaño ?? 'N/A' }}</td>
                            <td class="border p-2">{{ $detalle->dedicatoria ?? 'N/A' }}</td>
                            <td class="border p-2">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Servicios del Pedido -->
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
                @foreach($venta->detalles as $detalle)
                    @if ($detalle->servicio)
                        <tr>
                            <td class="border p-2">{{ $detalle->servicio->nombre }}</td>
                            <td class="border p-2">{{ $detalle->cantidad }}</td>
                            <td class="border p-2">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <!-- Botón para regresar -->
        <a href="{{ route('admin.verPedidos') }}" class="block bg-blue-600 text-white text-center py-2 rounded mt-6 hover:bg-blue-700 transition-colors">
            Volver al Listado
        </a>
    </div>
</section>
@endsection
