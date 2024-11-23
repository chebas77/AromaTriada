@extends('recursos.app')

@section('title', 'Tracking de Envíos')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-8">Estado de tu Envío</h1>

    @if ($tracking->isEmpty())
        <p>No tienes envíos en proceso.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($tracking as $item)
                <div class="border p-4 rounded-lg shadow bg-white">
                    <h3 class="text-lg font-bold mb-2">Envío #{{ $item->id_tracking }}</h3>
                    <p><strong>Origen:</strong> {{ $item->origen }}</p>
                    <p><strong>Destino:</strong> {{ $item->destino }}</p>
                    <p><strong>Estado Actual:</strong> {{ $item->estado_actual }}</p>
                    <p><strong>Fecha de Despacho:</strong> {{ $item->fecha_despacho ?? 'Pendiente' }}</p>
                    <p><strong>Fecha de Entrega:</strong> {{ $item->fecha_entrega ?? 'Pendiente' }}</p>
                    <p><strong>Hora Programada:</strong> {{ $item->hora_programada ?? 'Pendiente' }}</p>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
