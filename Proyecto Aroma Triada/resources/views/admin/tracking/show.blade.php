@extends('recursos.base_admin')
@section('title', 'Gestionar Tracking')

@section('content')
<section class="container mx-auto py-12 px-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Gestionar Tracking</h1>
    
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <p class="mb-4"><strong>ID Pedido:</strong> {{ $tracking->id_venta }}</p>
        <p class="mb-4"><strong>Estado Actual:</strong> {{ $tracking->estado_actual }}</p>
        <p class="mb-4"><strong>Origen:</strong> {{ $tracking->origen }}</p>
        <p class="mb-4"><strong>Destino:</strong> {{ $tracking->destino }}</p>
        <p class="mb-4"><strong>Fecha de Entrega:</strong> {{ $tracking->fecha_entrega ?? 'Pendiente' }}</p>
        <p class="mb-4"><strong>Hora Programada:</strong> {{ $tracking->hora_programada ?? 'Pendiente' }}</p>

        <!-- Formulario para Actualizar Tracking -->
        <form action="{{ route('admin.tracking.actualizar', $tracking->id_tracking) }}" method="POST" class="mt-8">
            @csrf
            @method('PUT')

            <!-- Seleccionar Estado -->
            <div class="mb-4">
                <label for="estado_actual" class="block text-gray-700 font-bold mb-2">Nuevo Estado</label>
                <select name="estado_actual" id="estado_actual" class="w-full border rounded-lg px-4 py-2">
                    <option value="Preparando envío" {{ $tracking->estado_actual == 'Preparando envío' ? 'selected' : '' }}>Preparando envío</option>
                    <option value="En proceso" {{ $tracking->estado_actual == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Enviado" {{ $tracking->estado_actual == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="Entregado" {{ $tracking->estado_actual == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                    <option value="Cancelado" {{ $tracking->estado_actual == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>
            </div>

            <!-- Fecha de Despacho -->
            <div class="mb-4">
                <label for="fecha_despacho" class="block text-gray-700 font-bold mb-2">Fecha de Despacho</label>
                <input type="datetime-local" name="fecha_despacho" id="fecha_despacho" 
                       value="{{ $tracking->fecha_despacho ? $tracking->fecha_despacho->format('Y-m-d\TH:i') : '' }}"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            <!-- Botones -->
            <div class="flex justify-between">
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    Actualizar Información
                </button>
                <a href="{{ route('admin.tracking.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600">
                    Regresar
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
