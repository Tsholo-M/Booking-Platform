@extends('layouts.organizer')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Welcome to your Dashboard, {{ Auth::user()->name }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Events -->
        <div class="p-4 border rounded-lg shadow-sm bg-white">
            <h2 class="text-lg font-semibold">Total Events</h2>
            <p class="text-3xl font-bold">{{ $totalEvents }}</p>
        </div>

        <!-- Total Bookings -->
        <div class="p-4 border rounded-lg shadow-sm bg-white">
            <h2 class="text-lg font-semibold">Total Bookings</h2>
            <p class="text-3xl font-bold">{{ $totalBookings }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="p-4 border rounded-lg shadow-sm bg-white">
            <h2 class="text-lg font-semibold">Total Revenue</h2>
            <p class="text-3xl font-bold">R {{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>
</div>
@endsection
