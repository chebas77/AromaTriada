<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AROMA TRIADA - Servicios de Catering y Tortas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'aroma-red': '#d32f2f',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans">
    <header class="bg-aroma-red text-white p-4 flex justify-between items-center">
        <div class="text-2xl font-bold">AROMA TRIADA</div>
        <div class="flex-grow mx-4">
            <input type="text" placeholder="Buscar..." class="w-full p-2 rounded text-black">
        </div>
        <div class="flex items-center">
            <a href="#servicios" class="mr-4 hover:underline">SERVICIOS</a>
            <a href="#contacto" class="mr-4 hover:underline">CONTACTANOS</a>
            <span class="bg-white text-aroma-red px-3 py-1 rounded">913988385</span>
        </div>
    </header>

    <main>
        <section class="flex justify-between p-5">
            <img src="https://v0.dev/placeholder.svg" alt="Variedad de postres" class="w-[48%]">
            <img src="https://v0.dev/placeholder.svg" alt="Variedad de postres" class="w-[48%]">
        </section>
        <QuienesSomos />

        <section id="vision" class="p-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold mb-4 text-aroma-red">Nuestra Visión</h2>
                <p class="text-lg">
                    En Aroma Triada, aspiramos a ser líderes en la industria de catering y repostería, reconocidos por nuestra excelencia en el servicio, la calidad de nuestros productos y nuestra capacidad para crear momentos memorables a través de la gastronomía. Nos esforzamos por innovar constantemente, respetando las tradiciones culinarias y utilizando ingredientes de la más alta calidad para satisfacer los paladares más exigentes.
                </p>
            </div>
        </section>

        <section id="servicios" class="bg-gray-100 p-8">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold mb-4 text-aroma-red">Nuestros Servicios</h2>
                <ul class="list-disc list-inside text-lg">
                    <li>Catering para eventos corporativos</li>
                    <li>Servicio de banquetes para bodas</li>
                    <li>Mesas dulces para cumpleaños y celebraciones</li>
                    <li>Tortas personalizadas para toda ocasión</li>
                    <li>Servicio de coffee break para reuniones y conferencias</li>
                    <li>Clases de repostería y decoración de tortas</li>
                </ul>
            </div>
        </section>
    </main>

    <footer id="contacto" class="bg-aroma-red text-white p-8">
        <div class="max-w-4xl mx-auto flex justify-between">
            <div>
                <h3 class="text-2xl font-bold mb-4">Contacto</h3>
                <p>Teléfono: 913988385</p>
                <p>Email: info@aromatriada.com</p>
                <p>Dirección: Calle Principal 123, Ciudad</p>
            </div>
            <div>
                <h3 class="text-2xl font-bold mb-4">Síguenos</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-gray-300">Facebook</a>
                    <a href="#" class="hover:text-gray-300">Instagram</a>
                    <a href="#" class="hover:text-gray-300">Twitter</a>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p>&copy; 2024 Aroma Triada. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>