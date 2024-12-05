
@extends('layouts.app')

@section('title', $event->name)

@section('content')
    <h1>{{ $event->name }}</h1>
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>Date & Time:</strong> {{ $event->date_time }}</p>
    <p><strong>Category:</strong> {{ $event->category->name }}</p>
    <p><strong>Max Attendees:</strong> {{ $event->max_attendees }}</p>
    <p><strong>Ticket Price:</strong> ${{ $event->ticket_price }}</p>
    
    <!-- Optionally, you can add a link to edit or delete the event -->
    @if(Auth::id() == $event->organizer_id)
        <a href="{{ route('organizer.events.edit', $event->id) }}">Edit Event</a>
        <form action="{{ route('organizer.events.delete', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Event</button>
        </form>
    @endif
@endsection
