@extends('layouts.app') {{-- Usa el layout principal de Jetstream --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Ventas</h1>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">ID Pedido</th>
                    <th class="border px-4 py-2 bg-gray-100">Usuario</th>
                    <th class="border px-4 py-2 bg-gray-100">Estado</th>
                    <th class="border px-4 py-2 bg-gray-100">Total</th>
                    <th class="border px-4 py-2 bg-gray-100">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td class="border px-4 py-2">{{ $pedido->id_pedido }}</td>
                    <td class="border px-4 py-2">{{ $pedido->user->name ?? 'Usuario desconocido' }}</td>
                    <td class="border px-4 py-2">{{ $pedido->estado }}</td>
                    <td class="border px-4 py-2">${{ number_format($pedido->total, 2) }}</td>
                    <td class="border px-4 py-2">{{ $pedido->fecha }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
