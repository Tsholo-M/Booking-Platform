@extends('layouts.organizer')

@section('title', 'Manage Events')

@section('content')
    <h1>My Events</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="event-list">
        @forelse ($events as $event)
            <div class="event-item">
                <h2>{{ $event->name }}</h2>
                <p><strong>Description:</strong> {{ Str::limit($event->description, 150) }}</p>
                <p><strong>Date:</strong> {{$event->date_time}} </p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Category:</strong> {{ $event->category->name }}</p>
                <p><strong>Max Attendees:</strong> {{ $event->max_attendees }}</p>
                <p><strong>Ticket Price:</strong> ${{ number_format($event->ticket_price, 2) }}</p>

                <div class="event-actions">
                    <a href="{{ route('organizer.events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                    <a href="{{ route('organizer.events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('organizer.events.delete', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No events found. <a href="{{ route('organizer.events.create') }}">Create one</a>.</p>
        @endforelse
    </div>

@endsection
