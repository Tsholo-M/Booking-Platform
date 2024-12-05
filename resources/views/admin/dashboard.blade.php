@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
    <div class="grid grid-cols-4 gap-6">
        <div class="bg-blue-100 p-4 rounded-lg text-center">
            <h2 class="text-xl font-semibold">Total Users</h2>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg text-center">
            <h2 class="text-xl font-semibold">Total Events</h2>
            <p class="text-2xl font-bold">{{ $totalEvents }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg text-center">
            <h2 class="text-xl font-semibold">Total Bookings</h2>
            <p class="text-2xl font-bold">{{ $totalBookings }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg text-center">
            <h2 class="text-xl font-semibold">Total Revenue</h2>
            <p class="text-2xl font-bold">R{{ number_format($totalRevenue, 2) }}</p>
        </div>
    </div>
</div>
@endsection
