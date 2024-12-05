@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <h1>Edit Event</h1>

    <form action="{{ route('organizer.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- This directive tells Laravel to use the PUT method for updating -->

        <div>
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" required>
        </div>

        <div>
            <label for="date_time">Date & Time:</label>
            <input type="datetime-local" id="date_time" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="" disabled>Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="max_attendees">Maximum Attendees:</label>
            <input type="number" id="max_attendees" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}" required>
        </div>

        <div>
            <label for="ticket_price">Ticket Price:</label>
            <input type="number" step="0.01" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}" required>
        </div>

        <button type="submit">Update Event</button>
    </form>
@endsection
