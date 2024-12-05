@extends('layouts.user')

@section('content')
<div class="container mx-auto p-6">
    <!-- Welcome Message -->
    <h1 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name }}!</h1>

    <!-- My Bookings Section -->
    <section class="mb-8">
        <h2 class="text-xl font-semibold border-b-2 border-gray-300 pb-2 mb-4">My Bookings</h2>
        @if($bookings->isEmpty())
            <p class="text-gray-500">You haven't made any bookings yet.</p>
        @else
            <ul class="space-y-4">
                @foreach($bookings as $booking)
                    <li class="bg-white shadow-md rounded-lg p-4">
                        <h3 class="text-lg font-semibold">{{ $booking->event->name }}</h3>
                        <p class="text-gray-600"><strong>Status:</strong> {{ $booking->status }}</p>
                        <p class="text-gray-600"><strong>Booking Date:</strong> {{ $booking->created_at->format('F d, Y h:i A') }}</p>
                        <div class="mt-3 flex items-center space-x-4">
                            <a href="{{ route('bookings.show', $booking->id) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">
                                View Details
                            </a>

                            @php
                                $hasReviewed = $booking->event->reviews()->where('user_id', Auth::id())->exists();
                            @endphp

                            @if (!$hasReviewed)
                                <a href="{{ route('reviews.create', $booking->event->id) }}" 
                                   class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">
                                    Leave a Review
                                </a>
                            @else
                                <p class="text-green-600">You have already reviewed this event.</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <!-- Upcoming Events Section -->
    <section>
        <h2 class="text-xl font-semibold border-b-2 border-gray-300 pb-2 mb-4">Upcoming Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upcomingEvents as $event)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-semibold">{{ $event->name }}</h3>
                    <p class="text-gray-600">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                    <p class="text-gray-600 mt-2"><strong>Date:</strong> {{ $event->date_time }}</p>
                    <div class="mt-4">
                        <a href="{{ route('events.show', $event->id) }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
