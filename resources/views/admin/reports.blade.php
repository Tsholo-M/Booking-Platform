@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">Reports</h1>
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-gray-100 p-4 rounded">
            <h2 class="text-xl font-semibold">Monthly Revenue</h2>
            <ul>
                @foreach ($monthlyRevenue as $data)
                <li>{{ $data->month }}: R{{ number_format($data->total, 2) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="bg-gray-100 p-4 rounded">
            <h2 class="text-xl font-semibold">Monthly Bookings</h2>
            <ul>
                @foreach ($monthlyBookings as $data)
                <li>{{ $data->month }}: {{ $data->total }} bookings</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
