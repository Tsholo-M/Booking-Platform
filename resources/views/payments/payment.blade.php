@extends('layouts.app')

@section('content')
    <h1>Payment Details</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Booking: {{ $booking->event->name }}</h2>
    <p>Amount: ${{ number_format($booking->event->price * $booking->attendees, 2) }}</p>
    
    <form action="{{ route('payments.process', $booking->id) }}" method="POST" id="payment-form">
        @csrf
        <div id="payment-element">
            <!-- A Stripe Element will be inserted here -->
        </div>
        <!-- Used to display form errors -->
        <div id="payment-message"></div>

        <button type="submit" id="submit">Pay Now</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config("services.stripe.key") }}');
        var elements = stripe.elements();

        // Create a Payment Element
        var paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.confirmPayment({
                elements: elements,
                confirmParams: {
                    return_url: "{{ route('booking.show', $booking->id) }}", // Redirect after successful payment
                },
            }).then(function (result) {
                if (result.error) {
                    // Show error message to the user
                    var messageElement = document.getElementById('payment-message');
                    messageElement.textContent = result.error.message;
                }
            });
        });
    </script>
@endsection
