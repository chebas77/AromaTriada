@extends('recursos.base_admin')
@section('title', 'Gestionar Tracking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Gestionar Tracking</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- Mostrar información no editable -->
        <p class="mb-4"><strong>ID Pedido:</strong> {{ $tracking->id_venta }}</p>
        <p class="mb-4"><strong>Estado Actual:</strong> {{ $tracking->estado_actual }}</p>
        <p class="mb-4"><strong>Origen:</strong> {{ $tracking->origen }}</p>
        <p class="mb-4"><strong>Destino:</strong> {{ $tracking->destino }}</p>
        <p class="mb-4"><strong>Fecha de Entrega:</strong> {{ $tracking->fecha_entrega ?? 'No definida' }}</p>
        <p class="mb-4"><strong>Hora Programada:</strong> {{ $tracking->hora_programada ?? 'No definida' }}</p>

        <!-- Formulario para actualizar estado y fecha de despacho -->
        <form action="{{ route('admin.tracking.update', $tracking->id_tracking) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Estado -->
            <div>
                <label for="estado_actual" class="block text-gray-700 font-bold">Nuevo Estado</label>
                <select id="estado_actual" name="estado_actual" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    @foreach ($enumValues as $value)
                        <option value="{{ $value }}" {{ $tracking->estado_actual == $value ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de despacho -->
            <div>
                <label for="fecha_despacho" class="block text-gray-700 font-bold">Fecha de Despacho</label>
                <input type="datetime-local" id="fecha_despacho" name="fecha_despacho" 
                       value="{{ $tracking->fecha_despacho ? $tracking->fecha_despacho->format('Y-m-d\TH:i') : '' }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Actualizar Información
                </button>
                <a href="{{ route('admin.tracking.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Regresar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
