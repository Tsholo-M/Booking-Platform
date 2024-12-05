<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Event Booking Platform</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gradient-to-br from-purple-500 via-blue-500 to-indigo-600 min-h-screen flex flex-col justify-between text-gray-100">
        <!-- Navbar -->
        <div class="absolute top-0 right-0 p-6 flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-lg font-semibold hover:underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-lg font-semibold hover:underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-lg font-semibold hover:underline">Register</a>
                    @endif
                @endauth
            @endif
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-6 py-16 text-center">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-20 w-auto text-orange-400">
                    <circle cx="31" cy="32.5" r="31" fill="currentColor" />
                    <text x="31" y="38" text-anchor="middle" fill="white" font-size="18" font-weight="bold">Event</text>
                </svg>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl font-extrabold mb-4">Discover and Book Amazing Events</h1>
            <p class="text-lg mb-6">Explore concerts, workshops, and exclusive experiences. Book your spot today!</p>

            <!-- Search Bar -->
            <div class="relative max-w-xl mx-auto mb-10">
                <input type="text" placeholder="Search for events..." class="w-full px-4 py-3 rounded-full shadow-md focus:ring-2 focus:ring-orange-400 text-gray-800">
                <button class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-orange-500 text-white px-6 py-2 rounded-full shadow hover:bg-orange-600">Search</button>
            </div>

         

        <!-- Featured Events -->
        <div class="bg-gray-100 py-12">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center mb-6">Featured Events</h2>
            <div class="flex justify-center gap-6 overflow-x-auto px-6">
                <!-- Placeholder Events -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold">Music Festival</h3>
                    <p class="text-gray-600">Dec 10, 2024</p>
                </div>
                <div class="min-w-[200px] bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold">Tech Expo</h3>
                    <p class="text-gray-600">Jan 5, 2025</p>
                </div>
                <div class="min-w-[200px] bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold">Art Workshop</h3>
                    <p class="text-gray-600">Feb 15, 2025</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 py-6 text-center text-gray-400">
            <p class="mb-4">© 2024 Event Booking Platform. All Rights Reserved.</p>
            <div class="flex justify-center gap-4">
                <a href="#" class="hover:text-white">Facebook</a>
                <a href="#" class="hover:text-white">Twitter</a>
                <a href="#" class="hover:text-white">Instagram</a>
            </div>
        </footer>
    </body>
</html>
