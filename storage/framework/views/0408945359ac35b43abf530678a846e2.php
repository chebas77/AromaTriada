<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafc;
            color: #333;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em;
            color: #2c3e50;
        }

        .table-container {
            width: 90%;
            margin: 20px auto;
            overflow-x: auto;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        th {
            background-color: #34495e;
            color: #ffffff;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.03em;
        }

        tbody tr {
            transition: background-color 0.2s ease-in-out;
        }

        tbody tr:nth-child(odd) {
            background-color: #f7f9fc;
        }

        tbody tr:hover {
            background-color: #ecf0f1;
        }

        td {
            font-size: 14px;
            color: #2c3e50;
        }

        .footer {
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 10px;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <h1>Reporte de Ventas</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <?php if(in_array('ID Venta', $columnas)): ?> <th>ID Venta</th> <?php endif; ?>
                    <?php if(in_array('Usuario', $columnas)): ?> <th>Usuario</th> <?php endif; ?>
                    <?php if(in_array('Total', $columnas)): ?> <th>Total</th> <?php endif; ?>
                    <?php if(in_array('Fecha', $columnas)): ?> <th>Fecha</th> <?php endif; ?>
                    <?php if(in_array('Estado', $columnas)): ?> <th>Estado</th> <?php endif; ?>
                    <?php if(in_array('Metodo Pago', $columnas)): ?> <th>Método Pago</th> <?php endif; ?>
                    <?php if(in_array('Metodo Entrega', $columnas)): ?> <th>Método Entrega</th> <?php endif; ?>
                    <?php if(in_array('Direccion Entrega', $columnas)): ?> <th>Dirección Entrega</th> <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php if(in_array('ID Venta', $columnas)): ?> <td><?php echo e($venta->id_pedido); ?></td> <?php endif; ?>
                    <?php if(in_array('Usuario', $columnas)): ?> <td><?php echo e($venta->usuario->name ?? 'N/A'); ?></td> <?php endif; ?>
                    <?php if(in_array('Total', $columnas)): ?> <td><?php echo e(number_format($venta->total, 2)); ?></td> <?php endif; ?>
                    <?php if(in_array('Fecha', $columnas)): ?> <td><?php echo e($venta->fecha->format('d/m/Y')); ?></td> <?php endif; ?>
                    <?php if(in_array('Estado', $columnas)): ?> <td><?php echo e($venta->estado); ?></td> <?php endif; ?>
                    <?php if(in_array('Metodo Pago', $columnas)): ?> <td><?php echo e($venta->metodo_pago); ?></td> <?php endif; ?>
                    <?php if(in_array('Metodo Entrega', $columnas)): ?> <td><?php echo e($venta->metodo_entrega); ?></td> <?php endif; ?>
                    <?php if(in_array('Direccion Entrega', $columnas)): ?> <td><?php echo e($venta->direccion_entrega); ?></td> <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="footer">
        &copy; 2024 Reporte de Ventas Aroma Triada. Todos los derechos reservados.
    </div>
</body>
</html>
<?php /**PATH C:\Users\Sebas\Desktop\AromaTriada\Proyecto Aroma Triada\resources\views/admin/ventas_pdf.blade.php ENDPATH**/ ?>