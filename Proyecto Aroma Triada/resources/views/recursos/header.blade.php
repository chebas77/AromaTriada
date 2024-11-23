@vite('resources/css/app.css')
<div class="bg-gray-100 flex flex-col">
  <!-- Header -->
  <header class="bg-black text-white w-full">
    <div class="text-center py-1 text-xs">
      Envío Gratis a partir de $500.00
    </div>
    <nav class="w-full flex items-center justify-between py-4 px-6">
      <!-- Logo alineado a la izquierda -->
      <div class="text-xl font-bold flex-shrink-0">
        <a href="{{ route('aroma.index') }}">
          <img src="{{ asset('images/Logo_AromaTriada.jpeg') }}" alt="Logo Aroma Triada" class="h-8">
        </a>
      </div>

      <!-- Contenedor central para el menú de navegación -->
      <div class="flex justify-center flex-grow">
        <ul class="flex space-x-8">
          <li><a href="{{ route('aroma.index') }}" class="hover:underline">INICIO</a></li>
          <li><a href="{{ route('aroma.nosotros') }}" class="hover:underline">NOSOTROS</a></li>
          <li><a href="{{ route('aroma.preguntas') }}" class="hover:underline">PREGUNTAS</a></li>
          <li><a href="{{ route('aroma.catalogo') }}" class="hover:underline">CATÁLOGO</a></li>
        </ul>
      </div>

      <!-- Iconos alineados a la derecha -->
      <div class="flex space-x-6 items-center flex-shrink-0">
        <a href="#" class="hover:underline">🔍</a>
        <a href="{{ route('carrito.mostrar') }}" class="hover:underline">🛒</a>
        <a href="{{ route('aroma.perfil') }}" class="hover:underline">👤</a>
      </div>
    </nav>

    <!-- Sección de Iniciar Sesión / Registrarse alineada a la derecha -->
    <div class="w-full py-4 px-6 text-sm text-gray-500 text-right">
      @if(auth()->check())
        {{-- Si el usuario está autenticado y es administrador, muestra el enlace al panel de administración --}}
        @if(auth()->user()->esAdministrador())
          <a href="{{ route('admin.index') }}" class="hover:underline text-white">Panel de Administración</a> |
        @endif
        {{-- Muestra un enlace para cerrar sesión --}}
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="hover:underline text-white">Cerrar Sesión</button>
        </form>
      @else
        {{-- Enlace de inicio de sesión y registro para usuarios no autenticados --}}
        <a href="{{ route('aroma.inicioSesion') }}" class="hover:underline">Iniciar Sesión</a> /
        <a href="{{ route('aroma.registro') }}" class="hover:underline">Registrarse</a>
      @endif
    </div>
  </header>
</div>
