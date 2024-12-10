<?php $__env->startSection('title', 'Panel de Administración'); ?>
<?php $__env->startSection('content'); ?>

<div id="reportModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center hidden z-50">
    <div class="bg-white w-full max-w-3xl h-3/4 rounded-lg shadow-2xl p-6 relative overflow-hidden">
        <!-- Botón de cierre (X) en la esquina -->
        <button 
            onclick="document.getElementById('reportModal').classList.add('hidden')" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-4">📊 Reportes de Última Actualización</h2>

        <!-- Contenido con scroll -->
        <div class="overflow-y-auto h-full pr-2">
            <!-- Sección de Nuevas Ventas y Servicios -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">🛍️ Nuevas Ventas y Servicios</h3>
                <ul class="space-y-2">
                    <?php $__empty_1 = true; $__currentLoopData = $newSalesAndServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="bg-gray-100 p-3 rounded-lg shadow-sm flex justify-between items-center">
                            <span class="font-medium">Venta #<?php echo e($item->id_pedido); ?></span>
                            <span>S/ <?php echo e(number_format($item->total, 2)); ?></span>
                            <span class="text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i')); ?></span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="text-gray-500 italic">No hay nuevas ventas o servicios en las últimas 24 horas.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Sección de Productos con Stock 0 -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">🚨 Productos con Stock 0</h3>
                <div class="grid grid-cols-2 gap-4">
                    <ul class="list-disc pl-5 space-y-2">
                        <?php $__empty_1 = true; $__currentLoopData = $productsOutOfStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($index % 2 == 0): ?>
                                <li class="text-gray-800 font-medium"><?php echo e($product->nombre); ?></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="text-gray-500 italic">No hay productos con stock 0.</li>
                        <?php endif; ?>
                    </ul>
                    <ul class="list-disc pl-5 space-y-2">
    <?php $__empty_1 = true; $__currentLoopData = $productsOutOfStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($index % 2 == 1): ?>
            <li class="text-gray-800 font-medium"><?php echo e($product->nombre); ?></li>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <li class="text-gray-500 italic">No hay productos con stock 0.</li>
    <?php endif; ?>
</ul>

                </div>
            </div>
        </div>

        <!-- Botón para cerrar el modal -->
        <div class="flex justify-end mt-6">
            <button 
                onclick="document.getElementById('reportModal').classList.add('hidden')" 
                class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                Cerrar
            </button>
        </div>
    </div>
</div>


<main class="flex-1 p-2 bg-gray-50">
    <!-- Metrics Section -->
    <section class="px-2 py-3 mb-3">
        <div class="container mx-auto px-2 py-3">
            <h1 class="text-xs font-medium text-gray-800 mb-2">Panel de Administración</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                <!-- Usuarios conectados -->
                <div class="bg-blue-500 text-white p-2 rounded-lg shadow-sm flex items-center space-x-2 hover:shadow-md transition-shadow duration-300">
                    <div class="text-xl"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <h2 class="text-xs font-semibold">Usuarios Conectados</h2>
                        <p class="text-xs font-medium"><?php echo e($connectedUsers); ?></p>
                    </div>
                </div>

                <!-- Ventas realizadas -->
                <div class="bg-green-500 text-white p-2 rounded-lg shadow-sm flex items-center space-x-2 hover:shadow-md transition-shadow duration-300">
                    <div class="text-xl"><i class="fa-solid fa-shop"></i></div>
                    <div>
                        <h2 class="text-xs font-semibold">Ventas Totales</h2>
                        <p class="text-xs font-medium"><?php echo e($totalSales); ?></p>
                    </div>
                </div>

                <!-- Nuevos usuarios -->
                <div class="bg-yellow-500 text-white p-2 rounded-lg shadow-sm flex items-center space-x-2 hover:shadow-md transition-shadow duration-300">
                    <div class="text-xl"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <h2 class="text-xs font-semibold">Nuevos Usuarios Registrados</h2>
                        <p class="text-xs font-medium"><?php echo e($newUsers); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart Section (Gráfico de Ventas Mensuales) -->
    <section class="px-2 py-3 mb-3">
        <div class="bg-white rounded-lg shadow-sm p-2">
            <h2 class="text-xs font-semibold text-gray-800 mb-2">Ventas Mensuales</h2>
            <canvas id="myChart" class="w-full h-16"></canvas>
        </div>
    </section>

    <!-- Gráfico de Pizza (Productos más vendidos) -->
    <section class="px-2 py-3">
        <div class="flex space-x-4">
            <!-- Primer Gráfico de Pizza -->
            <div class="bg-white rounded-lg shadow-sm p-4 w-1/2">
                <h2 class="text-xs font-semibold text-gray-800 mb-2">Productos Más Vendidos</h2>
                <canvas id="productPieChart" class="w-full h-64"></canvas>
            </div>

            <!-- Segundo Gráfico de Métodos de Entrega -->
            <div class="bg-white rounded-lg shadow-sm p-4 w-1/2">
                <h2 class="text-xs font-semibold text-gray-800 mb-2">Ventas por Método de Entrega</h2>
                <canvas id="deliveryMethodsChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </section>
</main>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mostrar el modal automáticamente al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('reportModal').classList.remove('hidden');
    });

    // Gráfico de Ventas Mensuales
    const ctx1 = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($salesMonths, 15, 512) ?>,
            datasets: [{
                label: 'Ventas',
                data: <?php echo json_encode($salesTotals, 15, 512) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true, position: 'top' } },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Ventas' } },
                x: { title: { display: true, text: 'Mes' } }
            }
        }
    });

    // Gráfico de Productos Más Vendidos
    const ctx2 = document.getElementById('productPieChart').getContext('2d');
    const productPieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($soldProducts->pluck('product_name'), 15, 512) ?>,
            datasets: [{
                data: <?php echo json_encode($soldProducts->pluck('total_sold'), 15, 512) ?>,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            }]
        }
    });

    // Gráfico de Métodos de Entrega
    const ctx3 = document.getElementById('deliveryMethodsChart').getContext('2d');
    const deliveryMethodsChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($methods, 15, 512) ?>,
            datasets: [{
                label: 'Ventas por Método de Entrega',
                data: <?php echo json_encode($salesByMethod, 15, 512) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('recursos.base_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/indexadmin.blade.php ENDPATH**/ ?>