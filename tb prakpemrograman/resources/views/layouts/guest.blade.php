<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SIAkad') }} - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <style>
        .login-bg-overlay {
            background: linear-gradient(to right, rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.4));
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .text-glow {
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="antialiased text-white overflow-hidden bg-[#0f172a]">
    <div class="min-h-screen flex flex-col md:flex-row h-screen">
        
        <!-- Left Side: Cinematic Visuals (Desktop Only) -->
        <div class="hidden md:flex md:w-1/2 lg:w-3/5 h-full relative overflow-hidden">
            <img src="{{ asset('images/login-bg.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 login-bg-overlay backdrop-blur-[2px]"></div>
            
            <!-- Floating Decorative Elements -->
            <div class="absolute top-20 left-20 z-10 animate-float">
                <h1 class="text-8xl font-black tracking-tighter header-accent-text text-glow">
                    SIAkad
                </h1>
                <p class="text-blue-200/80 font-bold tracking-[0.5em] uppercase mt-6 text-lg">
                    Next-Gen Academic Solution
                </p>
            </div>

            <div class="absolute bottom-20 left-20 z-10 max-w-lg">
                <p class="text-xl text-blue-100/90 font-medium leading-relaxed italic">
                    "Memberdayakan pendidikan melalui teknologi inovatif untuk masa depan yang lebih cerah."
                </p>
                <div class="mt-8 flex gap-4">
                    <div class="h-1 w-24 bg-blue-500 rounded-full"></div>
                    <div class="h-1 w-12 bg-blue-500/30 rounded-full"></div>
                    <div class="h-1 w-6 bg-blue-500/10 rounded-full"></div>
                </div>
            </div>

            <!-- Animated Decoration -->
            <div class="absolute -bottom-20 -right-20 w-[400px] h-[400px] bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute -top-20 -right-20 w-[300px] h-[300px] bg-purple-600/20 rounded-full blur-[80px] animate-pulse" style="animation-delay: 3s;"></div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 lg:w-2/5 h-full flex items-center justify-center p-6 md:p-12 relative z-20">
            <!-- Mobile Logo Only -->
            <div class="absolute top-12 md:hidden text-center w-full px-6">
                <h1 class="text-5xl font-black header-accent-text">SIAkad</h1>
            </div>

            <div class="w-full max-w-md">
                @yield('content')
            </div>

            <!-- Footer Small -->
            <div class="absolute bottom-8 text-center w-full px-6 hidden md:block">
                <p class="text-white/20 text-[10px] font-black tracking-[0.3em] uppercase">
                    &copy; {{ date('Y') }} SIAkad • Excellence in Engineering
                </p>
            </div>
        </div>

    </div>
</body>
</html>

