@extends('layouts.user')

@section('title', 'Confirm Payment')

@section('content')
    <h1>Payment for {{ $booking->event->name }}</h1>
    <p>Amount: ${{ number_format($booking->event->price * $booking->attendees, 2) }}</p>

    <div id="payment-form"></div>
    <button id="pay-button">Pay Now</button>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', async () => {
            const {paymentMethod, error} = await stripe.createPaymentMethod({
                type: 'card',
                card: elements.getElement('cardNumber')
            });

            if (error) {
                alert(error.message);
            } else {
                // Send the payment method ID to the server
                fetch('{{ route("payments.process", $booking->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ payment_method_id: paymentMethod.id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.requires_action) {
                        stripe.handleCardAction(data.payment_intent_client_secret)
                            .then(result => {
                                if (result.error) {
                                    alert(result.error.message);
                                } else {
                                    location.reload();
                                }
                            });
                    } else if (data.success) {
                        alert('Payment successful!');
                        window.location.href = "{{ route('user.dashboard') }}";
                    } else {
                        alert('Payment failed.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
