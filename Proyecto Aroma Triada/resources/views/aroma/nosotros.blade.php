@extends('recursos.app')
@section('title', 'Nosotros')

@section('content')

<!-- Hero Section -->
<section class="bg-gray-200 py-20 flex items-center justify-center">
  <h1 class="text-3xl font-bold text-center">Nuestra Historia</h1>
</section>

<!-- About Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-2xl font-bold mb-4">¿Quiénes somos y cómo ayudamos a nuestros clientes?</h2>
  <p class="text-gray-700 mb-6">
    En Aroma Triada, nos dedicamos a ofrecer una experiencia única a nuestros clientes a través de productos artesanales de alta calidad y servicios de catering excepcionales. Creemos en la importancia de cada detalle para hacer de tus celebraciones momentos inolvidables. Desde deliciosos postres y tortas hasta servicios de catering personalizados, estamos comprometidos a brindar un servicio que supere tus expectativas.
  </p>
  <a href="{{ route('aroma.preguntas') }}" class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800">¿Tienes Dudas?</a>
</section>

<!-- Team Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h3 class="text-2xl font-bold mb-4">Nuestro Equipo</h3>
  <p class="text-gray-700 mb-8">
    Nuestro equipo está conformado por profesionales apasionados que trabajan arduamente para asegurar la mejor calidad en cada pedido. Desde la cocina hasta el servicio al cliente, cada miembro de nuestro equipo contribuye con su talento y dedicación.
  </p>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Team Member Card -->
    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4 flex items-center justify-center">
        <img src="path_to_image/team1.jpg" alt="Chef de Repostería" class="h-full object-cover rounded">
      </div>
      <h4 class="text-lg font-bold">Chef de Repostería</h4>
      <p class="text-gray-700">Ana Rodríguez</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4 flex items-center justify-center">
        <img src="path_to_image/team2.jpg" alt="Especialista en Catering" class="h-full object-cover rounded">
      </div>
      <h4 class="text-lg font-bold">Especialista en Catering</h4>
      <p class="text-gray-700">Luis García</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4 flex items-center justify-center">
        <img src="path_to_image/team3.jpg" alt="Gerente de Marketing" class="h-full object-cover rounded">
      </div>
      <h4 class="text-lg font-bold">Gerente de Marketing</h4>
      <p class="text-gray-700">María López</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4 flex items-center justify-center">
        <img src="path_to_image/team4.jpg" alt="Atención al Cliente" class="h-full object-cover rounded">
      </div>
      <h4 class="text-lg font-bold">Atención al Cliente</h4>
      <p class="text-gray-700">Carlos Pérez</p>
    </div>
  </div>
</section>

</div>
@endsection
