@extends('recursos.app')
@section('title', 'Perfil')

@section('content')

<!-- Profile Header -->
<section class="relative bg-gray-200 py-12">
   <!-- Imagen de fondo -->
   <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/fondo.jpg') }}'); z-index: 0;"></div>
  
  <!-- Capa de opacidad -->
  <div class="bg-black absolute inset-0 opacity-50"></div>

  <!-- Contenedor principal -->
  <div class="relative container mx-auto text-center z-10">
    <div class="flex flex-col items-center">
      
      <!-- Placeholder for Profile Picture -->
      <div class="relative w-32 h-32 rounded-full mb-4 overflow-hidden bg-white">
        <img src="{{ asset('images/perfil.jpg') }}" alt="Foto de perfil" class="w-full h-full object-cover">
      </div>



      <!-- Verificación de autenticación antes de mostrar nombre y correo -->
      @if(Auth::check())
      <h1 class="text-4xl text-crema3 font-bold">{{ Auth::user()->name }}</h1>
      <p class="text-crema3 mt-2">{{ Auth::user()->email }}</p>
      @else
      <h1 class="text-3xl font-bold">Usuario no autenticado</h1>
      <p class="text-gray-700 mt-2">Inicia sesión para ver tu perfil.</p>

      <!-- Botones de Iniciar Sesión y Registrarse -->
      <div class="mt-4 flex gap-4">
        <a href="{{ route('aroma.inicioSesion') }}" class="bg-black text-white px-4 py-2 rounded font-bold hover:bg-gray-800">Iniciar Sesión</a>
        <a href="{{ route('aroma.registro') }}" class="bg-black text-white px-4 py-2 rounded font-bold hover:bg-gray-800">Regístrate</a>
      </div>
      @endif

    </div>
  </div>
</section>

<!-- Resto del contenido del perfil -->
@if(Auth::check())
<!-- Profile Content -->
<section class="container mx-auto py-12 px-6">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Sidebar for Navigation -->
    <aside class="bg-crema1 shadow-lg rounded-lg p-6">
      <h2 class="text-xl text-violeta font-bold mb-4">Configuración de Cuenta</h2>
      <ul class="space-y-2">
        <li><a href="#personal-info" class="text-gray-700 hover:text-black font-medium">Información Personal</a></li>
        <li><a href="#order-history" class="text-gray-700 hover:text-black font-medium">Historial de Pedidos</a></li>
        <li><a href="#saved-items" class="text-gray-700 hover:text-black font-medium">Productos Guardados</a></li>
        <li><a href="#settings" class="text-gray-700 hover:text-black font-medium">Ajustes</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-500 hover:text-red-700 font-medium">Cerrar Sesión</a></li>
      </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
      </form>
    </aside>

    <!-- Main Content -->
    <!-- Order History Section -->

    <div class="lg:col-span-2 space-y-8">
        <!-- Personal Information Section -->
        <div id="personal-info" class="bg-crema1 shadow-lg rounded-lg p-6">
          <h3 class="text-2xl text-violeta font-bold mb-4">Información Personal</h3>
          @livewire('profile.update-profile-information-form')
        </div>

    <div id="order-history" class="bg-crema1 shadow-lg rounded-lg p-6">
      <h3 class="text-2xl text-violeta font-bold mb-4">Historial de Pedidos</h3>

      <!-- Lista con las primeras 10 compras -->
      <ul class="space-y-4">
        @forelse($compras->take(10) as $compra)
        <li class="p-4 bg-violeta rounded-lg flex justify-between items-center">
          <div>
            <p class="font-bold text-crema1">Pedido #{{ $compra->id_pedido }}</p>
            <p class="text-crema3">Fecha: {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>
            <p class="text-crema3">Total: S/ {{ number_format($compra->total, 2) }}</p>
          </div>
        </li>
        @empty
        <p class="text-violeta text-center">No has realizado ninguna compra aún.</p>
        @endforelse
      </ul>

      <!-- Botón Ver Más -->
      @if($compras->count() > 10)
      <div class="flex justify-center mt-4">
        <button
          onclick="document.getElementById('purchasesModal').classList.remove('hidden')"
          class="bg-black text-white px-4 py-2 rounded font-bold hover:bg-gray-800">
          Ver Más
        </button>
      </div>
      @endif

      <!-- Modal de Compras -->
      <div id="purchasesModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white w-2/3 rounded-lg shadow-lg p-6 relative">
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Compras Realizadas</h2>

          <!-- Lista de Todas las Compras -->
          <div class="overflow-y-auto max-h-96">
            @if($compras->isNotEmpty())
            <ul class="space-y-4">
              @foreach($compras as $compra)
              <li class="p-4 bg-gray-100 rounded-lg flex justify-between items-center">
                <div>
                  <p class="font-bold">Pedido #{{ $compra->id_pedido }}</p>
                  <p class="text-gray-700">Fecha: {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>
                  <p class="text-gray-700">Total: S/ {{ number_format($compra->total, 2) }}</p>
                </div>
              </li>
              @endforeach
            </ul>
            @else
            <p class="text-violeta text-center">No has realizado ninguna compra aún.</p>
            @endif
          </div>

          <!-- Botón para cerrar -->
          <div class="flex justify-end mt-4">
            <button
              onclick="document.getElementById('purchasesModal').classList.add('hidden')"
              class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Settings Section -->
    <div id="settings" class="bg-crema1 shadow-lg rounded-lg p-6">
      <h3 class="text-2xl text-violeta font-bold mb-4">Ajustes de Cuenta</h3>
      @livewire('profile.update-password-form')
    </div>
  </div>
  </div>
</section>
@endif
@endsection