@extends('layouts.guest')

@section('content')
<div class="space-y-8">
    <div class="text-left">
        <h2 class="text-4xl font-black text-white mb-2">Login</h2>
        <p class="text-blue-200/50 font-medium italic">Silakan masuk untuk melanjutkan akses akademik Anda.</p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 text-green-400 text-sm font-bold rounded-2xl glass">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div class="group">
            <label for="email" class="block text-[10px] font-black text-blue-300/60 uppercase tracking-[0.2em] mb-3 ml-1">Alamat Email Kampus</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-blue-400/30 group-focus-within:text-blue-400 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="block w-full bg-white/[0.03] border border-white/10 rounded-2xl py-5 pl-12 pr-4 text-white font-bold placeholder-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:bg-white/[0.07] transition-all duration-500" 
                    placeholder="Contoh: user@siakad.ac.id" />
            </div>
            @error('email') <p class="text-red-400/80 text-[10px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="group">
            <div class="flex justify-between items-center mb-3 px-1">
                <label for="password" class="block text-[10px] font-black text-blue-300/60 uppercase tracking-[0.2em]">Kata Sandi</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-blue-500 hover:text-blue-400 transition-colors uppercase tracking-wider">Lupa sandi?</a>
                @endif
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-blue-400/30 group-focus-within:text-blue-400 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </span>
                <input id="password" type="password" name="password" required
                    class="block w-full bg-white/[0.03] border border-white/10 rounded-2xl py-5 pl-12 pr-4 text-white font-bold placeholder-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:bg-white/[0.07] transition-all duration-500" 
                    placeholder="••••••••" />
            </div>
            @error('password') <p class="text-red-400/80 text-[10px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
        </div>

        <!-- Remember -->
        <div class="flex items-center mt-2 px-1">
            <label class="inline-flex items-center cursor-pointer group">
                <input type="checkbox" name="remember" class="rounded-lg border-white/10 bg-white/5 text-blue-600 w-5 h-5 focus:ring-blue-500/30 transition-all">
                <span class="ml-3 text-[10px] font-black text-blue-300/40 uppercase tracking-widest group-hover:text-blue-300/80 transition-colors">Tetap Keluar di Perangkat Ini</span>
            </label>
        </div>

        <!-- Submit -->
        <div class="pt-6">
            <button type="submit" class="btn-premium w-full !rounded-2xl py-5 shadow-2xl">
                <span class="tracking-[0.2em]">Masuk Sekarang</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </button>
        </div>
    </form>

    <!-- Social / Extra Info -->
    <div class="pt-8 text-center">
        <p class="text-[10px] font-bold text-white/10 uppercase tracking-[0.3em]">Authorized Access Only</p>
    </div>
</div>
@endsection

