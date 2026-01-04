@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.classrooms.index') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Edit Kelas</h2>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">Perbarui detail untuk kelas <strong>{{ $classroom->name }}</strong>.</p>
</div>

<div class="glass-card p-8 max-w-2xl mx-auto">
    <form action="{{ route('admin.classrooms.update', $classroom) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Kelas</label>
            <input type="text" name="name" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Contoh: IF-01" value="{{ old('name', $classroom->name) }}" required>
            @error('name') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Tahun Akademik</label>
            <select name="academic_year_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" {{ $classroom->academic_year_id == $year->id ? 'selected' : '' }}>{{ $year->name }} {{ $year->semester }}</option>
                @endforeach
            </select>
            @error('academic_year_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Dosen Wali (Wali Kelas)</label>
            <select name="advisor_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm">
                <option value="">Tanpa Dosen Wali</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}" {{ $classroom->advisor_id == $lecturer->id ? 'selected' : '' }}>{{ $lecturer->name }}</option>
                @endforeach
            </select>
            @error('advisor_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.classrooms.index') }}" class="px-8 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-white/60 shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                Perbarui Kelas
            </button>
        </div>
    </form>
</div>
@endsection
