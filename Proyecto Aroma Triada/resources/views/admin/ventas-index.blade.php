@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Ventas</h1>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">ID Pedido</th>
                    <th class="border px-4 py-2 bg-gray-100">Fecha</th>
                    <th class="border px-4 py-2 bg-gray-100">Estado</th>
                    <th class="border px-4 py-2 bg-gray-100">Total</th>
                    <th class="border px-4 py-2 bg-gray-100">Usuario</th>
                    <th class="border px-4 py-2 bg-gray-100">Método de Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                <tr>
                    <td class="border px-4 py-2">{{ $venta->id_pedido }}</td>
                    <td class="border px-4 py-2">{{ $venta->fecha }}</td>
                    <td class="border px-4 py-2">{{ $venta->estado }}</td>
                    <td class="border px-4 py-2">${{ number_format($venta->total, 2) }}</td>
                    <td class="border px-4 py-2">{{ $venta->usuario->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $venta->metodo_pago }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
    Regresar
</a>

@endsection
