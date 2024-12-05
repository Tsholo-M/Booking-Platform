@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $event->name }}</h1>
    <p><strong>Date and Time:</strong> {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y g:i A') }}</p> 
    <!-- Format the date and time nicely (e.g., Monday, December 1, 2024 2:00 PM) -->
    
    <p><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    
    <!-- Display available tickets -->
    <p><strong>Available Tickets:</strong> {{ $event->max_attendees - $event->current_bookings }}</p>
    
    <p><strong>Price:</strong> ${{ $event->ticket_price }}</p>

    <!-- Booking Form -->
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group">
            <label for="quantity">Number of Tickets:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" 
                   min="1" max="{{ $event->max_attendees - $event->current_bookings }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Book Now</button>
    </form>
</div>
@endsection
