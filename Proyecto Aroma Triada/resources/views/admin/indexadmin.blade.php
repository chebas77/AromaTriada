@extends('layouts.app') {{-- Asegúrate de usar tu layout principal --}}

@section('content')
<div class="container">
    <h1>Panel de Administración</h1>
    <p>Selecciona una sección para gestionar:</p>
    <ul>
        <li><a href="{{ route('admin.gestionarProductos') }}">Gestionar Productos</a></li>
        <li><a href="{{ route('admin.gestionarServicios') }}">Gestionar Servicios</a></li>
        <li><a href="{{ route('admin.gestionarUsuarios') }}">Gestionar Usuarios</a></li>
        <li><a href="{{ route('admin.verPedidos') }}">Gestionar Ventas/Pedidos</a></li>
    </ul>
</div>
@endsection