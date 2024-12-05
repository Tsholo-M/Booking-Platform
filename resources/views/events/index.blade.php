@extends('layouts.app')

@section('title', 'Browse Events')

@section('header', 'Explore Events')

@section('content')
    <h2>Search for Events</h2>
    <form method="GET" action="{{ route('events.index') }}">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">All Statuses</option>
            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Past</option>
        </select>

        <button type="submit">Search</button>
    </form>

    <h2>Search Results</h2>
    @if ($events->isEmpty())
        <p>No events found matching your criteria.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li>
                    <strong>{{ $event->name }}</strong><br>
                    <strong>Date:</strong> {{ $event->date_time }}<br>
                    <strong>Location:</strong> {{ $event->location }}<br>
                    <a href="{{ route('events.show', $event->id) }}">Book Now</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
