<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-600 flex items-center justify-center min-h-screen">
    <div class="bg-red-100 rounded-lg p-8 w-80 text-center shadow-lg">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">INICIA SESIÓN</h2>
        <p class="text-sm mb-4">¿No tienes una cuenta? <a href="#" class="text-red-500 hover:underline">únete ahora</a></p>
        <form>
            <input type="email" placeholder="correo electrónico" class="w-full px-4 py-2 mb-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>
            <input type="password" placeholder="contraseña" class="w-full px-4 py-2 mb-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>
            <a href="#" class="text-sm text-red-500 hover:underline block mb-3">olvidé mi contraseña</a>
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">iniciar sesión</button>
        </form>
        <div class="flex justify-between mt-4">
            <button class="w-5/12 bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">facebook</button>
            <button class="w-5/12 bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">google</button>
        </div>
    </div>
</body>
</html>
