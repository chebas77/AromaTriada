@extends('recursos.base_admin')
@section('title', 'Gestión de Almacen')
@section('content')
<main class="flex-1 p-6">
        <!-- Metrics Section -->
        <section class="px-6 py-8">
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Panel de Administración</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Usuarios conectados -->
                    <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="text-3xl">👥</div>
                        <div>
                            <h2 class="text-lg font-bold">Usuarios Conectados</h2>
                            <p>{{ $connectedUsers }}</p>
                        </div>
                    </div>

                    <!-- Ventas realizadas -->
                    <div class="bg-green-500 text-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="text-3xl">💰</div>
                        <div>
                            <h2 class="text-lg font-bold">Ventas Realizadas</h2>
                            <p>{{ $totalSales }}</p>
                        </div>
                    </div>

                    <!-- Nuevos usuarios -->
                    <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="text-3xl">🆕</div>
                        <div>
                            <h2 class="text-lg font-bold">Nuevos Usuarios</h2>
                            <p>{{ $newUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chart Section -->
        <section class="px-6 py-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold mb-4">Ventas Realizadas Mensualmente</h2>
                <canvas id="myChart" class="w-full h-64"></canvas>
            </div>
        </section>
    </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos del gráfico de ventas
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Cambiar a barra para diferenciar
        data: {
            labels: @json($salesMonths), // Meses obtenidos del controlador
            datasets: [{
                label: 'Cantidad de Ventas',
                data: @json($salesTotals), // Cantidad de ventas obtenidas del controlador
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Ventas'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mes'
                    }
                }
            }
        }
    });
</script>

@endsection
