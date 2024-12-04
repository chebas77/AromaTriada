<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Estilo Personalizado para el calendario -->
    <style>
        /* Estilización para input[type="date"] */
        input[type="date"] {
            appearance: none; /* Elimina el diseño por defecto del navegador */
            background: #ffffff; /* Fondo blanco */
            border: 1px solid #d1d5db; /* Borde gris claro */
            padding: 8px 12px; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            font-size: 16px; /* Tamaño de texto */
            color: #374151; /* Texto gris oscuro */
        }

        /* Borde y sombra cuando el campo está enfocado */
        input[type="date"]:focus {
            outline: none;
            border-color: #3b82f6; /* Borde azul al enfocar */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); /* Sombra azul */
        }

        /* Estilos adicionales para mejorar la apariencia */
        input[type="date"]::-webkit-calendar-picker-indicator {
            background-color: transparent; /* Fondo transparente en el ícono del calendario */
            cursor: pointer; /* Cambiar el cursor al hacer hover sobre el calendario */
        }

        /* Estilo para navegadores que usan -moz- */
        input[type="date"]::-moz-calendar-picker-indicator {
            background-color: transparent;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content') {{-- Se utiliza para vistas tradicionales --}}
            
            {{-- Solo si $slot está definido, se utilizará como componente --}}
            @isset($slot)
                {{ $slot }}
            @endisset
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
