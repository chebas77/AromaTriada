<!-- Footer -->
<footer class="bg-black text-white w-full mt-12 py-8">
  <div class="container mx-auto flex flex-wrap text-center md:text-left space-y-8 md:space-y-0">

    <!-- Navegación -->
    <div class="w-full md:w-1/4">
      <h3 class="font-bold mb-4 text-lg">Navegación</h3>
      <ul class="space-y-2 text-gray-400">
        <li><a href="{{ route('aroma.index') }}" class="hover:text-white">Inicio</a></li>
        <li><a href="{{ route('aroma.catalogo') }}" class="hover:text-white">Catálogo</a></li>
        <li><a href="#" class="hover:text-white">Carrito de Compras</a></li>
        <li><a href="#" class="hover:text-white">Contacto</a></li>
        <li><a href="{{ route('aroma.nosotros') }}" class="hover:text-white">Nosotros</a></li>
      </ul>
    </div>

    <!-- Contacto -->
    <div class="w-full md:w-1/4">
      <h3 class="font-bold mb-4 text-lg">Contacto</h3>
      <ul class="space-y-2 text-gray-400">
        <li><a href="tel:+1234567890" class="hover:text-white flex items-center"><span>📞</span>&nbsp; +1 (234) 567-890</a></li>
        <li><a href="mailto:info@marca.com" class="hover:text-white flex items-center"><span>✉️</span>&nbsp; info@marca.com</a></li>
        <li class="flex items-center"><span>📍</span>&nbsp; Calle Ficticia 123, Ciudad, País</li>
      </ul>
    </div>

    <!-- Redes Sociales -->
    <div class="w-full md:w-1/4">
      <h3 class="font-bold flex space-x-4 justify-center md:justify-start text-lg">Síguenos</h3>
      <div class="flex space-x-4 justify-center md:justify-start text-gray-400">
        <a href="https://facebook.com/marca" target="_blank" class="hover:text-white flex items-center space-x-1">
          <span>🔵</span> <span>Facebook</span>
        </a>
        <a href="https://instagram.com/marca" target="_blank" class="hover:text-white flex items-center space-x-1">
          <span>🔵</span> <span>Instagram</span>
        </a>
        <a href="https://twitter.com/marca" target="_blank" class="hover:text-white flex items-center space-x-1">
          <span>🔵</span> <span>Twitter</span>
        </a>
        
      </div>
    </div>

    <!-- Suscripción al Boletín -->
    <div class="w-full md:w-1/4">
      <h3 class="font-bold mb-4 text-lg">Suscríbete</h3>
      <p class="text-gray-400 mb-2">Recibe nuestras novedades y ofertas exclusivas</p>
      <form action="#" method="POST" class="flex flex-col">
        @csrf
        <input type="email" name="email" placeholder="Ingresa tu email" class="text-black p-2 rounded mb-2" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Suscribirse</button>
      </form>
    </div>
  </div>

  <div class="container mx-auto text-center mt-8">
    <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Marca. Todos los derechos reservados.</p>
    <div class="flex justify-center space-x-4 mt-4 text-gray-400">
      <a href="https://facebook.com/marca" target="_blank" class="hover:text-white">🔵</a>
      <a href="https://instagram.com/marca" target="_blank" class="hover:text-white">🔵</a>
      <a href="https://twitter.com/marca" target="_blank" class="hover:text-white">🔵</a>
    </div>
  </div>
</footer>
