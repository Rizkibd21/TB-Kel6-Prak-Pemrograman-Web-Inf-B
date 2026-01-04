<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAkad Core - Dosen Console</title>

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
            background: radial-gradient(circle at 20% 30%, rgba(219, 39, 119, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 80% 70%, rgba(30, 58, 138, 0.1) 0%, transparent 40%),
                        #020617;
            z-index: -10;
        }
        .sidebar-glow {
            box-shadow: 20px 0 80px -20px rgba(219, 39, 119, 0.15);
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
            text-shadow: 0 0 30px rgba(219, 39, 119, 0.4);
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
                    <div class="w-14 h-14 rounded-[2rem] bg-gradient-to-tr from-pink-600 via-rose-600 to-indigo-600 flex items-center justify-center text-white font-black text-2xl shadow-2xl shadow-pink-500/20 group-hover:rotate-[15deg] transition-all duration-700">
                        D
                    </div>
                    <div>
                        <span class="text-3xl font-black tracking-tighter header-accent-text block header-glow">SIAkad</span>
                        <span class="text-[9px] font-black text-pink-400/40 uppercase tracking-[0.4em]">Lecturer Console v2.0</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 mt-10 px-8 space-y-2 overflow-y-auto main-content pb-20">
                <div class="pb-4 text-[9px] font-black text-white/20 uppercase tracking-[0.5em] px-4">Navigation</div>
                
                <a href="{{ route('dosen.dashboard') }}"
                   class="sidebar-item {{ request()->routeIs('dosen.dashboard') ? 'active-vivid active-vivid-pink' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03] transition-all duration-500">
                    <div class="icon-box !w-10 !h-10 !rounded-2xl !bg-pink-600/10 !text-pink-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span class="text-[11px] font-black tracking-[0.2em]">DASHBOARD</span>
                </a>

                <div class="pt-8 pb-4 text-[9px] font-black text-white/20 uppercase tracking-[0.5em] px-4">Personal</div>

                <a href="{{ route('profile.edit') }}"
                   class="sidebar-item {{ request()->routeIs('profile.edit') ? 'active-vivid active-vivid-indigo' : '' }} !py-4 !px-6 !rounded-3xl hover:bg-white/[0.03]">
                    <div class="icon-box text-indigo-400 !w-10 !h-10 !rounded-2xl !bg-indigo-400/10">👤</div>
                    <span class="text-[11px] font-black tracking-[0.2em]">PROFIL SAYA</span>
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-8">
                <div class="bg-white/[0.02] border border-white/[0.03] p-5 rounded-[2.5rem] flex items-center justify-between group cursor-pointer hover:bg-white/[0.05] transition-all duration-500">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img class="h-12 w-12 rounded-2xl object-cover ring-4 ring-pink-500/10 group-hover:ring-pink-500/30 transition-all duration-500" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=db2777&color=fff' }}">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-4 border-slate-900 animate-pulse"></div>
                        </div>
                        <div>
                            <div class="text-[11px] font-black text-white truncate w-24 uppercase tracking-widest">{{ Auth::user()->name }}</div>
                            <div class="text-[8px] font-black text-pink-400/60 uppercase tracking-[0.3em]">Lecturer Active</div>
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
                        <h1 class="text-[10px] font-black text-pink-400/50 uppercase tracking-[0.6em] hidden sm:block">Control Panel / <span class="text-pink-400">@yield('page_title', 'Root')</span></h1>
                    </div>
                </div>

                <div class="flex items-center gap-8 text-white">
                    <!-- Notifications -->
                    <div class="relative group">
                        <button class="flex items-center p-3 bg-white/5 rounded-2xl hover:bg-white/10 transition-all border border-white/[0.03]">
                            <svg class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-slate-900 shadow-sm"></span>
                            @endif
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-4 w-96 bg-slate-900 border border-white/5 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden z-20 hidden group-hover:block backdrop-blur-3xl bg-opacity-80">
                             <div class="p-6">
                                <h4 class="text-[10px] font-black text-white/40 uppercase tracking-[0.4em] mb-6 px-2">Recent Alerts</h4>
                                <div class="space-y-3">
                                    @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                        <a href="{{ route('notifications.index') }}" class="flex items-start p-4 rounded-3xl hover:bg-white/5 transition border border-transparent hover:border-white/5 group/notif">
                                            <div class="w-2 h-2 mt-2 rounded-full bg-pink-500 mr-4 shadow-[0_0_10px_rgba(236,72,153,0.5)]"></div>
                                            <div>
                                                <span class="font-black block text-[10px] text-pink-400 uppercase tracking-widest mb-1">{{ $notification->data['subject_name'] ?? 'System' }}</span>
                                                <p class="text-white/60 text-[11px] leading-relaxed font-bold">{{ $notification->data['message'] }}</p>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="py-12 text-center">
                                            <div class="text-[10px] font-black text-white/20 uppercase tracking-widest italic">All systems clear</div>
                                        </div>
                                    @endforelse
                                </div>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <a href="{{ route('notifications.index') }}" class="block text-center text-[10px] text-pink-400 py-4 hover:text-white transition-colors font-black uppercase tracking-[0.2em] mt-2">View Analytics Terminal</a>
                                @endif
                             </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 bg-white/5 p-2 pr-6 rounded-2xl hover:bg-white/10 transition-all duration-500 border border-white/[0.03]">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-pink-600 to-rose-600 flex items-center justify-center text-white shadow-xl">
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
