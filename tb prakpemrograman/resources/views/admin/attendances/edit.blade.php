@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <a href="{{ route('admin.attendances.index') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Koreksi Absensi</h2>
    </div>
    <p class="text-gray-600 dark:text-gray-400 ml-12">Ubah status kehadiran untuk pencatatan manual atau perbaikan data.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Student Detail -->
    <div class="lg:col-span-1">
        <div class="glass-card p-8 bg-gradient-to-br from-indigo-600 to-purple-700 text-white shadow-xl">
             <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center text-3xl font-extrabold mb-6 border border-white/30 backdrop-blur-md">
                {{ substr($attendance->user->name, 0, 1) }}
            </div>
            <h3 class="text-2xl font-extrabold mb-1">{{ $attendance->user->name }}</h3>
            <p class="text-indigo-100 font-bold text-sm tracking-widest uppercase mb-6">{{ $attendance->user->nim }}</p>
            
            <div class="space-y-4 pt-6 border-t border-white/20">
                <div class="flex justify-between items-center bg-white/10 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-100 text-xs font-bold uppercase">Kelas</span>
                    <span class="font-extrabold">{{ $attendance->schedule->classroom->name }}</span>
                </div>
                <div class="flex justify-between items-center bg-white/10 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-100 text-xs font-bold uppercase">Mata Kuliah</span>
                    <span class="font-extrabold">{{ $attendance->schedule->subject->name }}</span>
                </div>
                <div class="flex justify-between items-center bg-white/10 p-3 rounded-xl border border-white/10">
                    <span class="text-indigo-100 text-xs font-bold uppercase">Tanggal</span>
                    <span class="font-extrabold">{{ \Carbon\Carbon::parse($attendance->date)->format('d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="lg:col-span-2">
        <div class="glass-card p-8 h-full bg-white/80">
            <form action="{{ route('admin.attendances.update', $attendance) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-3">Pilih Status Baru</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach(['hadir', 'izin', 'sakit', 'alfa'] as $status)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="status" value="{{ $status }}" class="peer hidden" {{ $attendance->status == $status ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-gray-100 rounded-2xl text-center transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 group-hover:bg-gray-50">
                                <span class="block text-xs font-extrabold uppercase tracking-widest text-gray-500 peer-checked:text-indigo-600 mb-1">{{ $status }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('status') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-wider mb-2">Catatan / Alasan</label>
                    <textarea name="notes" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm" placeholder="Contoh: Keterlambatan kendaraan atau surat sakit telah diverifikasi.">{{ old('notes', $attendance->notes) }}</textarea>
                    @error('notes') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.attendances.index') }}" class="px-8 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-gray-200 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
