@vite('resources/css/app.css')
<footer class="bg-violeta text-white w-full mt-12 py-8">
  <div class="container mx-auto flex flex-wrap text-center md:text-left md:items-start">

  <!-- Navegación -->
  <div class="w-full md:w-1/3 flex flex-col items-start mt-16">
  <a href="{{ route('aroma.index') }}" class="logo no-underline">
        AROMA TRIADA
    </a>
    </div>

    <!-- Navegación -->
    <div class="w-full md:w-1/4 flex flex-col items-start">
      <h3 class="font-bold mb-4 text-2xl">Navegación</h3>
      <ul class="space-y-2 text-white">
        <li><a href="{{ route('aroma.index') }}" class="hover:text-custom-hover">Inicio</a></li>
        <li><a href="{{ route('aroma.catalogo') }}" class="hover:text-custom-hover">Catálogo</a></li>
        <li><a href="{{ route('aroma.nosotros') }}" class="hover:text-custom-hover">Nosotros</a></li>
        <li><a href="{{ route('aroma.inicioSesion') }}" class="hover:text-custom-hover">Tracking</a></li>
      </ul>
    </div>

    <!-- Contacto -->
    <div class="w-full md:w-1/4 flex flex-col items-start">
    <h3 class="font-bold mb-4 text-2xl">Contacto</h3>
    <ul class="space-y-2 text-white">
    <li>
    <a href="https://wa.me/51990751294?text=¡Hola!%20Estoy%20interesado%20en%20hacer%20un%20pedido" class="hover:text-custom-hover" target="_blank">
        <i class="fa-solid fa-phone text-2xl text-white"></i> 
        <span>&nbsp; +51 990751294</span>
    </a>
      </li>

        <li>
            <a href="mailto:aromatriada@gmail.com" class="hover:text-custom-hover">
                <i class="fa-solid fa-envelope text-2xl text-white"></i> 
                <span>&nbsp; aromatriada@gmail.com</span>
            </a>
        </li>
        <li class="flex items-center space-x-4">
            <i class="fa-solid fa-map-pin text-2xl"></i>
            <span>&nbsp; Calle Cascanueces 111, Lima, Perú</span>
        </li>
    </ul>
</div>


    <!-- Redes Sociales -->
    <div class="w-full md:w-1/6 flex flex-col items-start">
    <h3 class="font-bold mb-4 text-2xl">Síguenos</h3>
    <div class="flex space-x-4 text-gray-400">
        <!-- Facebook Icon -->
        <a href="https://facebook.com/marca" target="_blank">
            <i class="fa-brands fa-facebook-square text-3xl text-white"></i>
        </a>

        <!-- Instagram Icon -->
        <a href="https://instagram.com/" target="_blank">
            <i class="fa-brands fa-instagram-square text-3xl text-white"></i>
        </a>

        <!-- Twitter Icon -->
        <a href="https://twitter.com/marca" target="_blank">
            <i class="fa-brands fa-twitter-square text-3xl text-white"></i>
        </a>
    </div>
</div>


  <div class="container mx-auto text-center mt-12">
    <p class="text-md text-white">&copy; {{ date('Y') }} Aroma Triada. Todos los derechos reservados.</p>
  </div>
</footer>
