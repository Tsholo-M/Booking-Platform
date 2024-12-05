@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Booking Details</h1>

    @if($booking->event) <!-- Check if event exists -->
        <p><strong>Event:</strong> {{ $booking->event->name }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->event->date)->format('l, F j, Y g:i A') }}</p>
        <p><strong>Location:</strong> {{ $booking->event->location }}</p>
        <p><strong>Tickets:</strong> {{ $booking->quantity }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</p>

        <h2>Your QR Code</h2>
        @if($booking->qr_code)
            <img src="data:image/png;base64,{{ $booking->qr_code }}" alt="QR Code">
        @else
            <p>QR Code not available.</p>
        @endif
    @else
        <p>Event details are not available.</p>
    @endif

    <a href="{{ route('events.index') }}" class="btn btn-primary">Back to Events</a>
</div>
@endsection
