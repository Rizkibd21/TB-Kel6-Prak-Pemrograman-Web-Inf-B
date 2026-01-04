@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.subjects.index') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Edit Mata Kuliah</h2>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">Perbarui detail untuk mata kuliah <strong>{{ $subject->name }}</strong>.</p>
</div>

<div class="glass-card p-8 max-w-2xl mx-auto">
    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Kode Mata Kuliah</label>
            <input type="text" name="code" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Contoh: MK001" value="{{ old('code', $subject->code) }}" required>
            @error('code') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Mata Kuliah</label>
            <input type="text" name="name" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Contoh: Pemrograman Web" value="{{ old('name', $subject->name) }}" required>
            @error('name') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">SKS</label>
            <input type="number" name="sks" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Contoh: 3" value="{{ old('sks', $subject->sks) }}" required min="1">
            @error('sks') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.subjects.index') }}" class="px-8 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-white/60 shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                Perbarui Mata Kuliah
            </button>
        </div>
    </form>
</div>
@endsection
