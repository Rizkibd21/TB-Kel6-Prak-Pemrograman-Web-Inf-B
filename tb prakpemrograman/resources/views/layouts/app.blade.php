<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Tombol utama */
        .btn-primary {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Navbar & Footer */
        nav, footer {
            background-color: #ffffff;
            transition: background-color 0.3s;
        }
        nav.dark, footer.dark {
            background-color: #1f2937;
        }

        /* Link hover effect */
        a {
            transition: color 0.2s;
        }
        a:hover {
            color: #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="min-h-screen flex flex-col">

        @if(Auth::check())
        <!-- Navbar Minimal -->
        <nav class="shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-4">
                        <a href="{{ url('/dashboard') }}" class="font-bold text-xl text-indigo-600 hover:text-indigo-800 transition">{{ config('app.name', 'MyApp') }}</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-lg shadow-sm">
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-primary">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        @endif

        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-6">
            @yield('content')
        </main>
        
        <!-- Footer Minimal -->
        <footer class="shadow-inner p-4 text-center text-sm text-gray-500 dark:text-gray-400 mt-auto border-t border-gray-200 dark:border-gray-700">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </footer>
    </div>
</body>
</html>