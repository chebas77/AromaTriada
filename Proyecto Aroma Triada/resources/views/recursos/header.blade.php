<div class="bg-white flex flex-col">
    <!-- Header -->
    <header class="bg-violeta text-black w-full">
        <!-- Banner de promociones -->
        <div class="bg-crema1 text-black text-center py-2 text-xs -ml-2">
            APROVECHA LOS NUEVOS LANZAMIENTOS POR ÉPOCAS NAVIDEÑAS!!
        </div>
        
        <!-- Barra de navegación -->
        <nav class="w-full flex items-center justify-between py-2 px-12 mt-8">
            <!-- Logo alineado a la izquierda -->
            <div class="flex items-center justify-start">
                <a href="{{ route('aroma.index') }}" class="logo no-underline text-white text-3xl font-fascinate">
                    AROMA TRIADA
                </a>
            </div>

            <!-- Menú de navegación alineado a la derecha -->
            <div class="flex justify-center flex-grow -ml-48">
                <ul class="flex space-x-24 text-white">
                    <li><a href="{{ route('aroma.index') }}" class="hover:underline">INICIO</a></li>
                    <li><a href="{{ route('aroma.nosotros') }}" class="hover:underline">NOSOTROS</a></li>
                    <li><a href="{{ route('aroma.preguntas') }}" class="hover:underline">PREGUNTAS</a></li>
                    <li><a href="{{ route('aroma.catalogo') }}" class="hover:underline">CATÁLOGO</a></li>
                </ul>
            </div>

            <!-- Enlaces de usuario (carrito y perfil) -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('carrito.mostrar') }}" class="hover:underline">
                    <i class="fa-solid fa-cart-shopping text-white text-2xl"></i>
                </a>
                <a href="{{ route('aroma.perfil') }}" class="hover:underline">
                    <i class="fa-solid fa-user text-white text-2xl"></i>
                </a>
            </div>
        </nav>

        <!-- Sección de inicio de sesión / registrarse -->
        <div class="w-full py-2 px-12 text-sm text-white text-right">
            @if(auth()->check())
                @if(auth()->user()->esAdministrador())
                    <a href="{{ route('admin.index') }}" class="hover:underline text-white">Panel de Administración</a> |
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="hover:underline text-white">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('aroma.inicioSesion') }}" class="hover:underline text-white">Iniciar Sesión |</a>
                <a href="{{ route('aroma.registro') }}" class="hover:underline text-white">Registrarse</a>
            @endif
        </div>
    </header>
</div>
