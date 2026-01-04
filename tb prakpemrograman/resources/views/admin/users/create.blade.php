@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.users.index') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Tambah Pengguna Baru</h2>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">Buat akun untuk mahasiswa, dosen, atau administrator.</p>
</div>

<div class="glass-card p-8 max-w-2xl mx-auto bg-gradient-to-br from-white to-indigo-50/30">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @error('name') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @error('email') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Role</label>
                <select name="role" id="role" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" onchange="toggleFields()">
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
                @error('role') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="nim-field">
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Nomor Induk Mahasiswa">
                @error('nim') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="nidn-field" class="hidden">
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">NIDN</label>
                <input type="text" name="nidn" value="{{ old('nidn') }}" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Nomor Induk Dosen Nasional">
                @error('nidn') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @error('password') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
            </div>
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-white/60 shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                Simpan Pengguna
            </button>
        </div>
    </form>
</div>

<script>
    function toggleFields() {
        const role = document.getElementById('role').value;
        const nimField = document.getElementById('nim-field');
        const nidnField = document.getElementById('nidn-field');

        if (role === 'mahasiswa') {
            nimField.classList.remove('hidden');
            nidnField.classList.add('hidden');
        } else if (role === 'dosen') {
            nimField.classList.add('hidden');
            nidnField.classList.remove('hidden');
        } else {
            nimField.classList.add('hidden');
            nidnField.classList.add('hidden');
        }
    }
    toggleFields();
</script>
@endsection
