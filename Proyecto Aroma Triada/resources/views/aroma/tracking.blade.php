@extends('recursos.app')

@section('title', 'Estado de tu Envío')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-8 text-center">Estado de tu Envío</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tracking as $item)
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Envío #{{ $item->id_tracking }}</h3>
            <p><strong>Origen:</strong> {{ $item->origen }}</p>
            <p><strong>Destino:</strong> {{ $item->destino }}</p>
            <p><strong>Estado Actual:</strong> {{ $item->estado_actual }}</p>
            <p><strong>Fecha de Despacho:</strong> {{ $item->fecha_despacho ?? 'Pendiente' }}</p>
            <p><strong>Fecha de Entrega:</strong> {{ $item->fecha_entrega ? $item->fecha_entrega->format('Y-m-d') : 'Pendiente' }}</p>
            <p><strong>Hora Programada:</strong> {{ $item->hora_programada ?? 'Pendiente' }}</p>
            <a href="{{ route('tracking.detalle', $item->id_tracking) }}" 
               class="block mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition-colors">
               Ver Detalles
            </a>
        </div>
        @endforeach
    </div>
</section>
@endsection
