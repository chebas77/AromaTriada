@extends('recursos.app')
@section('title', 'Perfil')

@section('content')

<!-- Profile Header -->
<section class="bg-gray-200 py-12">
  <div class="container mx-auto text-center">
    <div class="flex flex-col items-center">
      <!-- Placeholder for Profile Picture -->
      <div class="w-32 h-32 bg-gray-400 rounded-full mb-4"></div> 
      
      <!-- Verificación de autenticación antes de mostrar nombre y correo -->
      @if(Auth::check())
        <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
        <p class="text-gray-700 mt-2">{{ Auth::user()->email }}</p>
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
      <aside class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Configuración de Cuenta</h2>
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
      <div class="lg:col-span-2 space-y-8">
        <!-- Personal Information Section -->
        <div id="personal-info" class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="text-2xl font-bold mb-4">Información Personal</h3>
          @livewire('profile.update-profile-information-form')
        </div>
      
        <!-- Order History Section -->
        <div id="order-history" class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="text-2xl font-bold mb-4">Historial de Pedidos</h3>
          <ul class="space-y-4">
            <li class="p-4 bg-gray-100 rounded-lg flex justify-between items-center">
              <div>
                <p class="font-bold">Pedido #12345</p>
                <p class="text-gray-700">Fecha: 01/01/2024</p>
              </div>
              <button class="bg-black text-white px-4 py-2 rounded font-bold hover:bg-gray-800">Ver Detalles</button>
            </li>
          </ul>
        </div>

        <!-- Saved Items Section -->
        <div id="saved-items" class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="text-2xl font-bold mb-4">Productos Guardados</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow p-4 rounded-lg">
              <div class="bg-gray-300 h-40 mb-4"></div>
              <p class="font-bold text-gray-800">Producto Guardado</p>
              <p class="text-gray-700 mb-4">$590.00</p>
              <button class="w-full bg-black text-white py-2 font-bold hover:bg-gray-800">Añadir al Carrito</button>
            </div>
          </div>
        </div>

        <!-- Settings Section -->
        <div id="settings" class="bg-white shadow-lg rounded-lg p-6">
          <h3 class="text-2xl font-bold mb-4">Ajustes de Cuenta</h3>
          @livewire('profile.update-password-form')
        </div>
      </div>
    </div>
  </section>
@endif

@endsection
