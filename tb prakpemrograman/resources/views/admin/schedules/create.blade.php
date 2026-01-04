@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.schedules.index') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Tambah Jadwal Perkuliahan</h2>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">Buat jadwal baru untuk mata kuliah dan kelas tertentu.</p>
</div>

<div class="glass-card p-8 max-w-4xl mx-auto">
    <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Mata Kuliah</label>
                <select name="subject_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->code }})</option>
                    @endforeach
                </select>
                @error('subject_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Kelas</label>
                <select name="classroom_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
                @error('classroom_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Dosen Pengampu</label>
                <select name="user_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                    <option value="">Pilih Dosen</option>
                    @foreach($lecturers as $lecturer)
                        <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Hari</label>
                <select name="day" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                    <option value="">Pilih Hari</option>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                @error('day') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Waktu Mulai</label>
                <input type="time" name="start_time" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @error('start_time') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Waktu Selesai</label>
                <input type="time" name="end_time" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" required>
                @error('end_time') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Ruangan (Opsional)</label>
                <input type="text" name="room" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all shadow-sm" placeholder="Contoh: R.301 or Lab Komputer">
                @error('room') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('admin.schedules.index') }}" class="px-8 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-white/60 shadow-sm">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                Simpan Jadwal
            </button>
        </div>
    </form>
</div>
@endsection
