<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Event Booking Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        /* Global Styles */
        body {
            background-color: #f3f4f6; /* Light background for sophistication */
            color: #1f2937; /* Dark gray for text readability */
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }
        header {
            background: linear-gradient(90deg, #2563eb, #1e40af); /* Blue gradient */
         
        }
        header a {
            color: #ffffff;
            transition: color 0.3s ease;
        }
        header a:hover {
            color: #facc15; /* Soft gold for elegance */
        }
        nav ul li {
            margin: 0 15px;
        }
       
        footer {
            background: linear-gradient(90deg, #2563eb, #1e40af); /* Blue gradient */
            color: #9ca3af; /* Subtle text color */
        }
        footer p {
            margin: 5px 0;
        }
        footer p span {
            color: #facc15;
        }
        button {
            background-color: #3b82f6; /* Modern blue for action buttons */
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: #2563eb; /* Slightly darker shade for hover */
        }
        a.button {
            background-color: #3b82f6;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        a.button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="shadow-md">
        <nav class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-3xl font-bold tracking-wide">
                🎉 EventBooking
            </a>
            <!-- Navigation Links -->
            <ul class="flex items-center space-x-6 text-sm font-medium">
                <li><a href="{{ route('home') }}">Home</a></li>

                @auth
                    @if (Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.categories') }}">Categories</a></li>
                        <li><a href="{{ route('admin.users') }}">Users</a></li>
                        <li><a href="{{ route('admin.events') }}">Events</a></li>
                        <li><a href="{{ route('admin.reports') }}">Reports</a></li>
                    @elseif (Auth::user()->role === 'organizer')
                        <li><a href="{{ route('organizer.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('organizer.events') }}">My Events</a></li>
                    @elseif (Auth::user()->role === 'user')
                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @endif

                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endauth
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
