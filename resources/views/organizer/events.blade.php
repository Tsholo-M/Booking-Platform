@extends('layouts.organizer')

@section('title', 'My Events')

@section('content')
    <h1>My Events</h1>
    @if ($events->isEmpty())
        <p>No events found. <a href="{{ route('events.create') }}">Create one</a>.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li>
                    <h2>{{ $event->name }}</h2>
                    <p>{{ $event->description }}</p>
                    <p><strong>Date:</strong> {{ $event->date_time }}</p>
                    <a href="{{ route('events.show', parameters: $event->id) }}">View Details</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
