@extends('recursos.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Gestión de Ventas</h1>

    {{-- Mensajes de éxito --}}
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de ventas --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">ID Venta</th>
                    <th class="px-4 py-2 border">Usuario</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Estado</th>
                   {{--  <th class="px-4 py-2 border">Acciones</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $venta->id_pedido }}</td>
                        <td class="px-4 py-2 border">{{ $venta->usuario->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">${{ number_format($venta->total, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $venta->fecha->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border">{{ $venta->estado }}</td>
                       {{--    <td class="px-4 py-2 border">
                           <a href="{{ route('admin.verPedidos', ['id' => $venta->id_pedido]) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Ver Detalles
                            </a>
                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<a href="{{  route('admin.index')}}" 
    class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600">
    Regresar
</a>
@endsection
