@extends('layouts.app')

@section('content')
<h1>Pay for Booking: {{ $booking->event->title }}</h1>
<p>Amount: R{{ number_format($booking->event->price, 2) }}</p>

<form id="payment-form">
    @csrf
    <input type="hidden" name="payment_method_id" id="payment_method_id">

    <button id="pay-button">Pay Now</button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
   const stripe = Stripe("{{ config('services.stripe.key') }}");

    const elements = stripe.elements();

    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: card,
        });

        if (error) {
            alert(error.message);
        } else {
            document.getElementById('payment_method_id').value = paymentMethod.id;
            form.submit();
        }
    });
</script>
@endsection
