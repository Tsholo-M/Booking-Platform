<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Organizer Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #e6f0fa; /* Light blue background */
        }
        main {
            flex: 1;
        }
        header {
            background: linear-gradient(90deg, #2563eb, #1e40af); /* Blue gradient */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            padding: 0.5rem 1rem;
            color: #fff;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .nav-link:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }
        .nav-item {
            margin: 0 1rem;
        }
        .main-container {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        footer {
            background-color: #1e3a8a;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Brand -->
            <a href="{{ route('organizer.dashboard') }}" class="text-2xl font-bold tracking-wide text-white">
                Organizer Dashboard
            </a>
            <!-- Navigation Links -->
            <ul class="flex items-center">
                <li class="nav-item">
                    <a href="{{ route('organizer.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('organizer.events.create') }}" class="nav-link">Create Event</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('organizer.events.show', $event->id ?? 0) }}" class="nav-link">View Event</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link bg-red-500 hover:bg-red-700">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="main-container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Event Booking Platform. All rights reserved.</p>
    </footer>
</body>
</html>
