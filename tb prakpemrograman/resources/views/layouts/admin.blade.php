<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAkad Core - Administrator</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            overflow: hidden;
            background-color: #020617;
        }
        .cinematic-bg {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(30, 58, 138, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 80% 70%, rgba(67, 56, 202, 0.1) 0%, transparent 40%),
                        #020617;
            z-index: -10;
        }
        .sidebar-glow {
            box-shadow: 20px 0 80px -20px rgba(30, 58, 138, 0.3);
        }
        .main-content::-webkit-scrollbar {
            width: 4px;
        }
        .main-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }
        .glass-nav {
            background: rgba(2, 6, 23, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }
        .header-glow {
            text-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>

<body class="antialiased text-slate-200">
    <div class="cinematic-bg"></div>
    
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-80 hidden md:flex flex-col z-30 relative sidebar-glow border-r border-white/5">
            <!-- Sidebar Background -->
            <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-3xl -z-10"></div>
            
            <div class="p-10 pb-6 text-center lg:text-left">
                <div class="flex items-center gap-4 group cursor-pointer justify-center lg:justify-start">
                    <div class="w-14 h-14 rounded-[2rem] bg-gradient-to-tr from-blue-600 via-indigo-600 to-violet-600 flex items-center justify-center text-white font-black text-2xl shadow-2xl shadow-blue-500/20 group-hover:rotate-[15deg] transition-all duration-700">
                        S
                    </div>
                    <div>
                        <span class="text-3xl font-black tracking-tighter header-accent-text block header-glow">SIAkad</span>
                        <span class="text-[9px] font-black text-blue-400/40 uppercase tracking-[0.4em]">Core Interface v2.0</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 mt-10 px-8 space-y-2 overflow-y-auto main-content pb-20">
                <div class="pb-4 text-[9px] font-black text-white/20 uppercase tracking-[0.5em] px-4">Terminal Console</div>
                
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active-vivid active-vivid-indigo' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03] transition-all duration-500">
                    <div class="icon-box !w-10 !h-10 !rounded-2xl !bg-blue-600/10 !text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="text-[11px] font-black tracking-[0.2em]">DASHBOARD</span>
                </a>

                <div class="pt-8 pb-4 text-[9px] font-black text-white/20 uppercase tracking-[0.5em] px-4">Academic Modules</div>

                <a href="{{ route('admin.academic-years.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.academic-years.*') ? 'active-vivid active-vivid-pink' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-pink-500 !w-10 !h-10 !rounded-2xl !bg-pink-500/10">📅</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">YEARS</span>
                </a>

                <a href="{{ route('admin.subjects.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.subjects.*') ? 'active-vivid active-vivid-cyan' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-cyan-400 !w-10 !h-10 !rounded-2xl !bg-cyan-400/10">📘</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">SUBJECTS</span>
                </a>

                <a href="{{ route('admin.classrooms.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.classrooms.*') ? 'active-vivid active-vivid-emerald' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-emerald-400 !w-10 !h-10 !rounded-2xl !bg-emerald-400/10">🏫</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">ROOMS</span>
                </a>

                <a href="{{ route('admin.schedules.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.schedules.*') ? 'active-vivid active-vivid-yellow' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-yellow-400 !w-10 !h-10 !rounded-2xl !bg-yellow-400/10">⏰</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">SCHEDULES</span>
                </a>

                <div class="pt-8 pb-4 text-[9px] font-black text-white/20 uppercase tracking-[0.5em] px-4">Core Records</div>

                <a href="{{ route('admin.attendances.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.attendances.*') ? 'active-vivid active-vivid-pink' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-rose-400 !w-10 !h-10 !rounded-2xl !bg-rose-400/10">🧾</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">ATTENDANCE</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active-vivid active-vivid-indigo' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-indigo-400 !w-10 !h-10 !rounded-2xl !bg-indigo-400/10">👥</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">DATABASE</span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                   class="sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active-vivid active-vivid-emerald' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-emerald-400 !w-10 !h-10 !rounded-2xl !bg-emerald-400/10">⚙️</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">SETTINGS</span>
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-8">
                <div class="bg-white/[0.02] border border-white/[0.03] p-5 rounded-[2.5rem] flex items-center justify-between group cursor-pointer hover:bg-white/[0.05] transition-all duration-500">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img class="h-12 w-12 rounded-2xl object-cover ring-4 ring-blue-500/10 group-hover:ring-blue-500/30 transition-all duration-500" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=3b82f6&color=fff' }}">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-4 border-slate-900 animate-pulse"></div>
                        </div>
                        <div>
                            <div class="text-[11px] font-black text-white truncate w-24 uppercase tracking-widest">{{ Auth::user()->name }}</div>
                            <div class="text-[8px] font-black text-blue-400/60 uppercase tracking-[0.3em]">System Admin</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="p-2 text-white/5 hover:text-red-400 transition-colors duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- NAVBAR -->
            <header class="h-24 flex items-center justify-between px-10 z-20 glass-nav">
                <div class="flex items-center gap-6">
                    <button class="md:hidden p-3 bg-white/5 rounded-2xl text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h11"/></svg>
                    </button>
                    <div>
                        <h1 class="text-[10px] font-black text-blue-400/50 uppercase tracking-[0.6em] hidden sm:block">Control Panel / <span class="text-blue-400">@yield('page_title', 'Root')</span></h1>
                    </div>
                </div>

                <div class="flex items-center gap-8">
                    <div class="hidden lg:flex items-center gap-4 px-6 py-2 bg-white/[0.02] border border-white/[0.03] rounded-full">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(59,130,246,0.8)]"></div>
                        <span class="text-[9px] font-bold text-blue-200/40 uppercase tracking-[0.3em]">Network Stable • 24ms</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 bg-white/5 p-2 pr-6 rounded-2xl hover:bg-white/10 transition-all duration-500 border border-white/[0.03]">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="text-[10px] font-black text-white uppercase tracking-[0.2em] hidden lg:block">Authorized Access</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto main-content p-10 pt-12">
                @if(session('success'))
                    <div class="mb-10 p-6 bg-emerald-500/5 border border-emerald-500/20 rounded-[2rem] flex items-center gap-6 animate-pulse">
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-emerald-500/40">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em]">System Message</p>
                            <p class="text-sm font-bold text-white mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="max-w-[1600px] mx-auto">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>
</body>
</html>


