@php
    // Menentukan layout berdasarkan role user
    $user = Auth::user();
    $role = $user->role ?? 'guest';
    $layoutName = ($role === 'mahasiswa') ? 'student' : $role;
    $layout = 'layouts.' . $layoutName;
@endphp

@extends($layout)

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Pengaturan Profil</h2>
    <p class="text-gray-600 dark:text-gray-400 mt-2">Perbarui informasi akun dan keamanan Anda.</p>
</div>

@if(session('status') === 'profile-updated')
    <div class="glass border-l-4 border-green-500 text-green-700 px-6 py-4 rounded shadow-lg mb-6 relative transition-opacity duration-500 ease-in-out opacity-100 animate-fade">
        Profil berhasil diperbarui.
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-4">
    <!-- Left: Profile Summary -->
    <div class="lg:col-span-1">
        <div class="glass-card p-8 text-center bg-gradient-to-br from-white to-indigo-50/30">
            <div class="relative inline-block mb-6">
                <img id="avatar-preview" class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-xl mx-auto" 
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&size=128&background=random' }}" 
                    alt="{{ $user->name }}" />
                <label for="avatar-input" class="absolute bottom-0 right-0 p-2 bg-indigo-600 text-white rounded-full shadow-lg cursor-pointer hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </label>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900">{{ $user->name }}</h3>
            <p class="text-sm font-bold text-indigo-600 uppercase tracking-widest mt-1">{{ $user->role }}</p>
            <div class="mt-4 px-4 py-2 bg-white/60 rounded-xl border border-white/60 text-xs font-bold text-gray-500 uppercase tracking-tighter">
                {{ $role === 'mahasiswa' ? $user->nim : ($role === 'dosen' ? $user->nidn : 'ID: --') }}
            </div>
        </div>
    </div>

    <!-- Right: Edit Form -->
    <div class="lg:col-span-2">
        <div class="glass-card p-8">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')
                <input type="file" name="avatar" id="avatar-input" class="hidden" 
                    onchange="document.getElementById('avatar-preview').src = window.URL.createObjectURL(this.files[0])">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                            value="{{ old('name', $user->name) }}" required />
                        @error('name') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Email</label>
                        <input id="email" name="email" type="email" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                            value="{{ old('email', $user->email) }}" required />
                        @error('email') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">No. HP</label>
                        <input id="phone" name="phone" type="text" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                            value="{{ old('phone', $user->phone) }}" />
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Alamat</label>
                        <input id="address" name="address" type="text" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                            value="{{ old('address', $user->address) }}" />
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100">
                    <h4 class="text-lg font-extrabold text-gray-800 mb-4">Ganti Password</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Password Baru</label>
                            <input id="password" name="password" type="password" 
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                                placeholder="••••••••" />
                            @error('password') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" 
                                placeholder="••••••••" />
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection