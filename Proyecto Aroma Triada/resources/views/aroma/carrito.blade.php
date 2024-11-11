@extends('recursos.app')
@section('title', 'Carrito')
@section('content')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Carrito de Compras -->
    <section class="container mx-auto my-12 px-4">
        <h1 class="text-3xl font-bold mb-8">Carrito de Compras</h1>
        <div class="md:flex md:space-x-8">
            <!-- Lista de Productos -->
            <div class="md:w-3/4">
                <div class="space-y-4">
                    <!-- Producto en el Carrito -->
                    <div class="flex items-center p-4 bg-white shadow rounded-lg">
                        <div class="w-24 h-24 bg-gray-200 flex items-center justify-center">
                            <!-- Imagen del producto -->
                            <span>Imagen</span>
                        </div>
                        <div class="ml-4 flex-grow">
                            <h2 class="font-semibold text-lg">Producto 1</h2>
                            <p class="text-gray-700">Precio Unitario: $199.00</p>
                            <div class="flex items-center mt-2">
                                <button class="p-2 border border-gray-300">-</button>
                                <span class="px-4">1</span>
                                <button class="p-2 border border-gray-300">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-700">Total: $199.00</p>
                            <button class="text-red-500 hover:underline mt-2">Eliminar</button>
                        </div>
                    </div>

                    <!-- Repetir para otros productos -->
                    <div class="flex items-center p-4 bg-white shadow rounded-lg">
                        <div class="w-24 h-24 bg-gray-200 flex items-center justify-center">
                            <span>Imagen</span>
                        </div>
                        <div class="ml-4 flex-grow">
                            <h2 class="font-semibold text-lg">Producto 2</h2>
                            <p class="text-gray-700">Precio Unitario: $299.00</p>
                            <div class="flex items-center mt-2">
                                <button class="p-2 border border-gray-300">-</button>
                                <span class="px-4">1</span>
                                <button class="p-2 border border-gray-300">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-700">Total: $299.00</p>
                            <button class="text-red-500 hover:underline mt-2">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen del Pedido -->
            <div class="md:w-1/4 mt-8 md:mt-0">
                <div class="p-6 bg-white shadow rounded-lg">
                    <h2 class="text-lg font-bold mb-4">Resumen del Pedido</h2>
                    <div class="flex justify-between mb-2">
                        <p>Subtotal</p>
                        <p>$498.00</p>
                    </div>
                    <div class="flex justify-between mb-2">
                        <p>Envío</p>
                        <p>$50.00</p>
                    </div>
                    <hr class="my-4">
                    <div class="flex justify-between text-lg font-bold">
                        <p>Total</p>
                        <p>$548.00</p>
                    </div>
                    <button class="w-full mt-6 bg-black text-white p-3 rounded hover:bg-gray-800">Proceder con el Pago</button>
                </div>
            </div>
        </div>
    </section>

    

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>

@endsection