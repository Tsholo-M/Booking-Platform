<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        /* Global Styles */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #e6f0fa; /* Light blue background */
        }
        main {
            flex: 1;
        }

        /* Navigation Bar */
        header {
            background: linear-gradient(90deg, #2563eb, #1e40af); /* Blue gradient */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Slight shadow */
        }
        .nav-link {
            padding: 0.5rem 1rem;
            color: #fff;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .nav-link:hover {
            background-color: #1d4ed8; /* Hover blue */
            transform: translateY(-2px); /* Lift on hover */
        }
        .nav-item {
            margin: 0 1rem; /* Space out navigation items */
        }

        /* Main Section */
        .main-container {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
            padding: 2rem;
            margin-top: 2rem;
        }
        .main-container h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e3a8a; /* Dark blue heading */
            margin-bottom: 1rem;
        }

        /* Footer */
        footer {
            background-color: #1e3a8a;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body class="text-gray-800 font-sans">

    <!-- Header -->
    <header>
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Brand -->
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold tracking-wide text-white">
                Admin Panel
            </a>
            <!-- Navigation Links -->
            <ul class="flex items-center">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('admin.categories') }}" class="nav-link">Categories</a></li>
                <li class="nav-item"><a href="{{ route('admin.users') }}" class="nav-link">Users</a></li>
                <li class="nav-item"><a href="{{ route('admin.events') }}" class="nav-link">Events</a></li>
                <li class="nav-item"><a href="{{ route('admin.reports') }}" class="nav-link">Reports</a></li>
            </ul>
            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="nav-link bg-red-500 hover:bg-red-700 text-white">
                    Logout
                </button>
            </form>
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
        <p>&copy; {{ date('Y') }} <span class="font-medium">Admin Panel</span>. All rights reserved.</p>
    </footer>
</body>
</html>
