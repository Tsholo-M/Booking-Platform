@extends('layouts.user')

@section('content')
    <h1>Leave a Review for {{ $event->name }}</h1>

    <form action="{{ route('reviews.store', $event->id) }}" method="POST">
        @csrf
        <div class="mt-3">
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
            <input type="number" name="rating" id="rating" min="1" max="5" class="w-20 p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mt-3">
            <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
            <textarea name="comment" id="comment" rows="4" class="w-full p-2 border border-gray-300 rounded"></textarea>
        </div>
        <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">Submit Review</button>
    </form>
@endsection
