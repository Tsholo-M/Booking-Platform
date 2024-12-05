<form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <label for="quantity">Number of Tickets:</label>
    <input type="number" name="quantity" min="1" max="{{ $event->max_attendees - $event->current_bookings }}" required>
    <button type="submit">Book Now</button>
</form>
