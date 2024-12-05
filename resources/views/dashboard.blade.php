@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="max-w-6xl mx-auto">
        <!-- Welcome Section -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 glow-effect">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 text-lg mb-4">
                We're excited to have you here. Your dashboard is your gateway to exploring events, managing your bookings, 
                and staying updated with everything happening on the platform. 
            </p>
            <p class="text-gray-600 text-lg">
                Use the navigation links above to explore events, check your bookings, or manage your account. If you have 
                any questions or need support, feel free to reach out to us. Happy exploring!
            </p>
        </div>

        <!-- Suggestions Section -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 glow-effect">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">What You Can Do</h2>
            <ul class="list-disc pl-5 text-gray-600 text-base space-y-2">
                <li>
                    <span class="font-medium">Browse upcoming events:</span> Find something that sparks your interest 
                    from a variety of categories and locations.
                </li>
                <li>
                    <span class="font-medium">View your bookings:</span> Quickly access details for events you’ve already 
                    signed up for.
                </li>
                <li>
                    <span class="font-medium">Rate and review events:</span> Share your feedback and help improve 
                    the community experience.
                </li>
                <li>
                    <span class="font-medium">Check recommendations:</span> Discover personalized events based on 
                    your interests.
                </li>
            </ul>
        </div>
    </div>
@endsection
