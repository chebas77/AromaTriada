@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago con Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form action="{{ route('charge') }}" method="POST" id="payment-form">
        @csrf
        <div>
            <label for="card-element">Tarjeta de crédito o débito</label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit">Pagar</button>
    </form>

    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Muestra el error en el formulario
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Inserta el token en el formulario
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Envia el formulario
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>