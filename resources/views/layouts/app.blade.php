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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilo Personalizado -->
    <style>
        input[type="date"] {
            appearance: none;
            background: #ffffff;
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 16px;
            color: #374151;
        }
        input[type="date"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            background-color: transparent;
            cursor: pointer;
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
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mostrar Modal Automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('tracking_id'))
                var trackingModal = new bootstrap.Modal(document.getElementById('trackingModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
                trackingModal.show();
            @endif
        });
    </script>
</body>
</html>
