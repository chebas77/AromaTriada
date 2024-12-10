@extends('recursos.app')
@section('title', 'Preguntas Frecuentes')

@section('content')

<!-- FAQ Section -->
<section class="container mx-auto py-12 px-6">
  <div class="text-center mb-12">
    <h2 class="text-3xl font-bold">Preguntas Frecuentes</h2>
    <p class="text-gray-700 mt-4">
      Encuentra respuestas a las preguntas más comunes sobre nuestros productos, servicios de catering, y procesos de compra. Si tienes alguna otra duda, no dudes en contactarnos.
    </p>  
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Category 1: General -->
    <div>
      <h3 class="text-xl font-bold mb-4">General</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Qué tipos de productos ofrecen?</summary>
          <p class="mt-2 text-gray-700">
            Ofrecemos una variedad de postres y tortas personalizadas, así como servicios de catering para eventos corporativos y personales.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Cómo puedo hacer un pedido en línea?</summary>
          <p class="mt-2 text-gray-700">
            Simplemente navega por nuestro catálogo, agrega los productos o servicios que desees al carrito y sigue los pasos de compra. Puedes personalizar algunos productos antes de agregarlos.
          </p>
        </details>
      </div>
    </div>

    <!-- Category 2: Productos y Personalización -->
    <div>
      <h3 class="text-xl font-bold mb-4">Productos y Personalización</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Puedo personalizar una torta o postre?</summary>
          <p class="mt-2 text-gray-700">
            Sí, ofrecemos opciones de personalización para nuestras tortas y postres, incluyendo dedicatorias y tamaños. Selecciona "personalizar" en el producto para ver las opciones disponibles.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Cuánto tiempo de anticipación necesito para hacer un pedido personalizado?</summary>
          <p class="mt-2 text-gray-700">
            Para asegurar la mejor calidad, recomendamos hacer pedidos personalizados con al menos 3 días de anticipación. En casos urgentes, contáctanos y veremos cómo ayudarte.
          </p>
        </details>
      </div>
    </div>

    <!-- Category 3: Servicios de Catering -->
    <div>
      <h3 class="text-xl font-bold mb-4">Servicios de Catering</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Qué incluye el servicio de catering?</summary>
          <p class="mt-2 text-gray-700">
            Nuestro servicio de catering incluye una selección de comidas, postres, bebidas, y servicios de montaje. Consulta nuestra sección de catering para ver los paquetes y precios detallados.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Puedo solicitar un catering para eventos corporativos?</summary>
          <p class="mt-2 text-gray-700">
            Sí, nuestros servicios están diseñados tanto para eventos corporativos como para celebraciones personales. Ofrecemos opciones adaptadas a las necesidades de cada tipo de evento.
          </p>
        </details>
      </div>
    </div>

    <!-- Category 4: Pagos y Facturación -->
    <div>
      <h3 class="text-xl font-bold mb-4">Pagos y Facturación</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Cuáles son los métodos de pago aceptados?</summary>
          <p class="mt-2 text-gray-700">
            Aceptamos pagos con tarjetas de crédito, débito, y transferencias bancarias. También puedes realizar pagos en efectivo en nuestro local.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Puedo solicitar una factura por mi compra?</summary>
          <p class="mt-2 text-gray-700">
            Sí, durante el proceso de pago, tendrás la opción de ingresar tus datos para recibir una factura electrónica en tu correo.
          </p>
        </details>
      </div>
    </div>

    <!-- Category 5: Envíos y Entregas -->
    <div>
      <h3 class="text-xl font-bold mb-4">Envíos y Entregas</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Hacen envíos a toda la ciudad?</summary>
          <p class="mt-2 text-gray-700">
            Sí, realizamos envíos a cualquier punto dentro de la ciudad. Los costos de envío pueden variar según la ubicación.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Qué sucede si no estoy en casa en el momento de la entrega?</summary>
          <p class="mt-2 text-gray-700">
            En caso de no encontrarte, te contactaremos para coordinar una segunda entrega o recoger el pedido en nuestra tienda.
          </p>
        </details>
      </div>
    </div>

    <!-- Category 6: Atención al Cliente -->
    <div>
      <h3 class="text-xl font-bold mb-4">Atención al Cliente</h3>
      <div class="space-y-4">
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Cómo puedo contactarlos si tengo algún problema con mi pedido?</summary>
          <p class="mt-2 text-gray-700">
            Puedes contactarnos a través de nuestra sección de contacto en el sitio web, enviarnos un correo electrónico o llamarnos directamente. Estamos aquí para ayudarte.
          </p>
        </details>
        <details class="bg-white shadow p-4 rounded">
          <summary class="font-medium cursor-pointer">¿Tienen políticas de devolución?</summary>
          <p class="mt-2 text-gray-700">
            Ofrecemos reembolsos o cambios en caso de problemas con nuestros productos o servicios, siempre que se presenten pruebas dentro de las primeras 24 horas tras la entrega.
          </p>
        </details>
      </div>
    </div>
  </div>
</section>
@endsection
