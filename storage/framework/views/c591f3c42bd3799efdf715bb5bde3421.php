<?php $__env->startSection('title', 'Catálogo de Productos'); ?>

<?php $__env->startSection('content'); ?>
<!-- Store Banner -->
<section class="bg-gray-200 py-12">
  <div class="container mx-auto text-center">
    <h1 class="text-3xl font-bold mb-2">Tienda</h1>
    <p class="text-gray-700">
      Bienvenido a nuestra tienda, donde encontrarás una selección exclusiva de productos y servicios para tus eventos especiales.
      Desde deliciosos postres y tortas hasta servicios personalizados como decoración y catering. Explora nuestro catálogo y descubre cómo podemos hacer de tu celebración algo único.
    </p>
  </div>
</section>

<!-- Main Content -->
<section class="container mx-auto py-12 px-6 flex flex-col md:flex-row gap-8">
  <!-- Sidebar -->
  <aside class="md:w-1/4">
    <h3 class="text-xl font-bold mb-4">Categorías</h3>
    <form action="<?php echo e(route('aroma.catalogo')); ?>" method="GET" class="bg-white p-4 rounded-lg shadow">
      <ul class="space-y-2">
        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <label class="flex items-center">
            <input
              type="checkbox"
              name="categorias[]"
              value="<?php echo e($categoria->id_categoria); ?>"
              class="mr-2"
              <?php echo e(in_array($categoria->id_categoria, request('categorias', [])) ? 'checked' : ''); ?>>
            <?php echo e($categoria->nombre); ?>

          </label>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <button
        type="submit"
        class="mt-4 w-full bg-red-600 hover:bg-blue-600 text-white px-4 py-2 rounded font-bold focus:outline-none">
        Filtrar
      </button>
    </form>
  </aside>

  <!-- Product and Service Grid -->
  <div class="md:w-3/4">
    <h2 class="text-lg font-medium mb-6">
      Mostrando <?php echo e($totalResultados); ?> <?php echo e($totalResultados === 1 ? 'resultado' : 'resultados'); ?>

    </h2>

    <?php if($totalResultados === 0): ?>
    <p>No hay productos ni servicios en esta categoría.</p>
    <?php else: ?>

    <!-- Productos -->
    <div class="mb-12">
      <h3 class="text-lg font-medium mb-4">Productos</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white shadow p-4 rounded">
          <div class="bg-gray-300 h-40 mb-4">
            <img src="<?php echo e($producto->imagen ? asset( $producto->imagen) : asset('images/placeholder.png')); ?>"
              alt="<?php echo e($producto->nombre); ?>" class="h-full w-full object-cover rounded">
          </div>
          <h4 class="text-sm font-bold text-gray-500"><?php echo e($producto->categoria->nombre ?? 'Sin categoría'); ?></h4>
          <p class="text-gray-800 mb-2 font-bold"><?php echo e($producto->nombre); ?></p>
          <p class="text-gray-700 font-bold mb-4">S/ <?php echo e(number_format($producto->precio, 2)); ?></p>

          <!-- Botón que redirige al detalle del producto -->
          <a href="<?php echo e(route('detalle.item', ['tipo' => 'producto', 'id' => $producto->id_producto])); ?>"
            class="bg-red-600 text-white px-6 py-2 font-bold hover:bg-blue-600 w-full rounded inline-block text-center">
            Ir a comprar
          </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/catalogo.blade.php ENDPATH**/ ?>