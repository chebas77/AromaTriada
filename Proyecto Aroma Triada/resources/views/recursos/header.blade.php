@vite('resources/css/app.css')
<div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
  <!-- Header -->
  <header class="bg-black text-white w-full">
    <div class="text-center py-1 text-xs">
      Envío Gratis a partir de $500.00
    </div>
    <nav class="container mx-auto flex items-center justify-between py-4 px-6">
      <div class="text-xl font-bold">
        <a href="{{ route('aroma.index') }}">
          <img src="{{ asset('images/Logo_AromaTriada.jpeg') }}" alt="Logo Aroma Triada" class="h-8">
        </a>
      </div>
      <ul class="flex space-x-4">
        <li><a href="{{route('aroma.index')}}" class="hover:underline"> INICIO </a></li>
        <li><a href="{{route('aroma.nosotros')}}" class="hover:underline">NOSOTROS</a></li>
        <li><a href="{{route('aroma.preguntas')}}" class="hover:underline">PREGUNTAS</a></li>
        <li><a href="{{route('aroma.catalogo')}}" class="hover:underline">CATALOGO</a></li>
      </ul>
      <div class="flex space-x-4 items-center">
        <a href="#" class="hover:underline">🔍</a>
        <a href="#" class="hover:underline">🛒</a>
        <a href="#" class="hover:underline">👤</a>
      </div>
    </nav>
  </header>