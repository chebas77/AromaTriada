@extends('recursos.app')
@section('title', 'Nosotros')

@section('content')

<!-- COMPLETAR CON INFORMACION DEL PROYECTO Y LOS INDESEABLES QUE LO ESTAN HACIENDO --> 


<!-- Hero Section -->
<section class="bg-gray-200 py-20 flex items-center justify-center">
  <h1 class="text-3xl font-bold text-center">Encabezado referente a la historia de tu negocio</h1>
</section>

<!-- About Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h2 class="text-2xl font-bold mb-4">¿Cómo ayudas a tus clientes?</h2>
  <p class="text-gray-700 mb-6">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur.
  </p>
  <button class="bg-black text-white px-6 py-2 font-bold hover:bg-gray-800">SABER MÁS</button>
</section>

<!-- Team Section -->
<section class="container mx-auto py-12 px-6 text-center">
  <h3 class="text-2xl font-bold mb-4">Tu Equipo</h3>
  <p class="text-gray-700 mb-8">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempus efficitur, ut rutrum ipsum.
  </p>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Team Member Card -->
    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h4 class="text-lg font-bold">Cargo</h4>
      <p class="text-gray-700">Nombre del Personal</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h4 class="text-lg font-bold">Cargo</h4>
      <p class="text-gray-700">Nombre del Personal</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h4 class="text-lg font-bold">Cargo</h4>
      <p class="text-gray-700">Nombre del Personal</p>
    </div>

    <div class="bg-white shadow p-4 rounded">
      <div class="bg-gray-300 h-40 mb-4"></div>
      <h4 class="text-lg font-bold">Cargo</h4>
      <p class="text-gray-700">Nombre del Personal</p>
    </div>
  </div>
</section>

</div>
@endsection