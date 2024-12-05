<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Event Booking Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <nav class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="{{ route('user.dashboard') }}" class="text-xl font-bold">Event Booking</a>
            <ul class="flex space-x-4">
                <li>
                    <a href="{{ route('user.dashboard') }}" class="hover:underline">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}" class="hover:underline">Browse Events</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="hover:underline">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 px-6">
        <div class="bg-white shadow-md rounded p-6">
            <h1 class="text-2xl font-bold mb-4">@yield('header')</h1>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 border border-green-200 rounded p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="bg-red-100 text-red-800 border border-red-200 rounded p-4 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Event Booking Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
