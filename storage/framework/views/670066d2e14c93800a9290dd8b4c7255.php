<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
<footer class="bg-black text-white w-full mt-12 py-8">
  <div class="container mx-auto flex flex-wrap text-center md:text-left md:items-start">

    <!-- Navegación -->
    <div class="w-full md:w-1/4 flex flex-col items-start">
      <h3 class="font-bold mb-4 text-lg">Navegación</h3>
      <ul class="space-y-2 text-gray-400">
        <li><a href="<?php echo e(route('aroma.index')); ?>" class="hover:text-white">Inicio</a></li>
        <li><a href="<?php echo e(route('aroma.catalogo')); ?>" class="hover:text-white">Catálogo</a></li>
        <li><a href="<?php echo e(route('aroma.nosotros')); ?>" class="hover:text-white">Nosotros</a></li>
        <li><a href="<?php echo e(route('tracking.mostrar')); ?>" class="hover:text-white">Tracking</a></li>
      </ul>
    </div>

    <!-- Contacto -->
    <div class="w-full md:w-1/4 flex flex-col items-start">
      <h3 class="font-bold mb-4 text-lg">Contacto</h3>
      <ul class="space-y-2 text-gray-400">
        <li><a href="tel:+51990751294" class="hover:text-white flex items-center"><span>📞</span>&nbsp; +51 990751294</a></li>
        <li><a href="mailto:aromatriada@gmail.com" class="hover:text-white flex items-center"><span>✉️</span>&nbsp; aromatriada@gmail.com</a></li>
        <li class="flex items-center"><span>📍</span>&nbsp; Calle Cascanueces 111, Lima, Perú</li>
      </ul>
    </div>

    <!-- Redes Sociales -->
    <div class="w-full md:w-1/4 flex flex-col items-start">
      <h3 class="font-bold mb-4 text-lg">Síguenos</h3>
      <div class="flex space-x-4 text-gray-400">
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
    <div class="w-full md:w-1/4 flex flex-col items-start">
      <h3 class="font-bold mb-4 text-lg">Suscríbete</h3>
      <p class="text-gray-400 mb-2">Recibe nuestras novedades y ofertas exclusivas</p>
      <form action="#" method="POST" class="flex flex-col">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Ingresa tu email" class="text-black p-2 rounded mb-2" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Suscribirse</button>
      </form>
    </div>
  </div>

  <div class="container mx-auto text-center mt-8">
    <p class="text-sm text-gray-400">&copy; <?php echo e(date('Y')); ?> Marca. Todos los derechos reservados.</p>
    <div class="flex justify-center space-x-4 mt-4 text-gray-400">
      <a href="https://facebook.com/marca" target="_blank" class="hover:text-white">🔵</a>
      <a href="https://instagram.com/marca" target="_blank" class="hover:text-white">🔵</a>
      <a href="https://twitter.com/marca" target="_blank" class="hover:text-white">🔵</a>
    </div>
  </div>
</footer>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/recursos/footer.blade.php ENDPATH**/ ?>