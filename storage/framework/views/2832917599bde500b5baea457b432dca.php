<?php $__env->startSection('title', 'Carrito de Compras'); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto py-12 px-6">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-900">Carrito de Compras</h1>

    <!-- Productos en el Carrito -->
    <?php if(session('carrito') && count(session('carrito')) > 0): ?>
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Productos en el Carrito</h2>
    
    <div class="space-y-8">
        <?php $__currentLoopData = session('carrito'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl space-x-6 items-center transition duration-300">
                
                <!-- Obtener el producto de la base de datos según el ID del carrito -->
                <?php
                    $producto = \App\Models\Producto::find($item['id']);
                ?>

                <div class="w-32 h-32">
                    <?php if($producto): ?>
                        <img src="<?php echo e($producto->imagen ? asset($producto->imagen) : asset('images/placeholder.png')); ?>"
                             alt="<?php echo e($producto->nombre); ?>"
                             class="w-full h-full object-cover rounded-lg">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/placeholder.png')); ?>"
                             alt="Producto no encontrado"
                             class="w-full h-full object-cover rounded-lg">
                    <?php endif; ?>
                </div>
                
                <div class="flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800"><?php echo e($item['nombre'] ?? 'Producto sin nombre'); ?></h3>
                    <?php if($item['tipo'] === 'producto'): ?>
                        <p class="text-sm text-gray-600">Tamaño: <?php echo e($item['tamano'] ?? 'No especificado'); ?></p>
                        <?php if($item['dedicatoria']): ?>
                            <p class="text-sm text-gray-600">Dedicatoria: <?php echo e($item['dedicatoria']); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <p class="font-semibold text-gray-800 mt-2">Precio unitario: S/ <?php echo e(number_format($item['precio_unitario'], 2)); ?></p>

                    <?php if($item['tipo'] === 'producto'): ?>
                        <form action="<?php echo e(route('carrito.actualizar')); ?>" method="POST" class="mt-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                            <div class="flex items-center space-x-4">
                                <label for="cantidad" class="text-gray-600">Cantidad:</label>
                                <select name="cantidad" class="border rounded-lg px-4 py-2 text-gray-800" onchange="this.form.submit()">
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($item['cantidad'] == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                    <p class="text-red-500 font-semibold mt-2">Total: S/ <?php echo e(number_format(($item['precio_unitario'] ?? 0) * $item['cantidad'], 2)); ?></p>
                </div>
                
                <form action="<?php echo e(route('carrito.eliminar')); ?>" method="POST" class="flex-shrink-0">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                        Eliminar
                    </button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <p class="text-center text-gray-600 mt-6">Tu carrito está vacío.</p>
    <?php endif; ?>

    <!-- Servicios Disponibles -->
    <section class="container mx-auto py-12 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Servicios Disponibles</h2>
        
        <form id="servicios-form" action="<?php echo e(route('carrito.agregarServicios')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
                <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="bg-white shadow-sm rounded-lg p-6 flex flex-col items-center space-y-4 text-center cursor-pointer transition transform hover:scale-105 hover:shadow-xl">
                        <input type="radio" name="servicio" value="<?php echo e($servicio->id_servicio); ?>" class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-700"><?php echo e($servicio->nombre); ?></h3>
                        <p class="text-gray-600">S/ <?php echo e(number_format($servicio->precio, 2)); ?></p>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Campo adicional si se selecciona "Mozo" -->
            <div id="mozo-options" class="mt-6 hidden">
                <label for="cantidad_mozos" class="block text-gray-600">Cantidad de Mozos:</label>
                <input type="number" name="cantidad_mozos" id="cantidad_mozos" min="1" value="1" class="border rounded-lg px-4 py-2 text-gray-800">
            </div>

            <!-- Botón para agregar servicios y confirmar carrito -->
            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    Agregar Servicios al Carrito
                </button>
            </div>
        </form>

        <!-- Botón para confirmar carrito -->
        <div class="mt-6">
            <form id="confirmar-carrito-form" action="<?php echo e(route('carrito.confirmar')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg w-full hover:bg-red-700 transition duration-300">
                    Confirmar Carrito
                </button>
            </form>
        </div>

        <!-- Botón para retroceder -->
        <div class="mt-6">
            <a href="<?php echo e(route('aroma.catalogo')); ?>" class="bg-gray-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                Retroceder
            </a>
        </div>
    </section>

    <script>
        // Mostrar campo de cantidad si se selecciona "Mozo"
        const servicioRadios = document.querySelectorAll('input[name="servicio"]');
        const mozoOptions = document.getElementById('mozo-options');

        servicioRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.parentElement.querySelector('h3').textContent.trim().toLowerCase() === 'mozo') {
                    mozoOptions.classList.remove('hidden');
                } else {
                    mozoOptions.classList.add('hidden');
                }
            });
        });
    </script>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/aroma/carrito.blade.php ENDPATH**/ ?>