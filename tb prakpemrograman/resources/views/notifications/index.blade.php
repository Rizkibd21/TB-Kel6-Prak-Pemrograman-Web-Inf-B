@php
    // Menentukan layout berdasarkan role user
    $role = Auth::user()->role ?? 'guest';
    $layoutName = ($role === 'mahasiswa') ? 'student' : $role; 
    $layout = 'layouts.' . $layoutName; 
@endphp

@extends($layout)

@section('content')
<!-- Header Section -->
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Notifikasi</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Pemberitahuan terbaru untuk Anda.</p>
    </div>
    <form action="{{ route('notifications.markAllRead') }}" method="POST">
        @csrf
        <button type="submit" class="flex items-center gap-2 px-5 py-2 bg-white/60 hover:bg-white text-gray-700 font-bold rounded-xl transition border border-white/60 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Tandai Semua Dibaca
        </button>
    </form>
</div>

<!-- Notification List -->
<div class="glass rounded-2xl overflow-hidden shadow-2xl border border-white/30">
    <div class="divide-y divide-gray-100/30">
        @forelse(auth()->user()->notifications as $notification)
            <div class="p-6 flex items-start gap-4 transition-colors hover:bg-white/20 {{ $notification->read_at ? 'opacity-80' : 'bg-white/10 dark:bg-gray-800/20' }}">
                
                <!-- Icon -->
                <div class="flex-shrink-0">
                    @if($notification->read_at)
                        <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-600 relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider">{{ $notification->data['subject_name'] ?? 'Pemberitahuan Sistem' }}</span>
                        <span class="text-[10px] font-semibold text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 font-medium leading-relaxed">{{ $notification->data['message'] }}</p>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="inline-block p-4 rounded-full bg-gray-50 dark:bg-gray-700 text-gray-300 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-gray-400 italic">Tidak ada notifikasi baru.</h3>
            </div>
        @endforelse
    </div>
</div>
@endsection