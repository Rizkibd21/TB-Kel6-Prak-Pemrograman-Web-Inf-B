@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Daftar Mata Kuliah</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola data mata kuliah yang tersedia di sistem.</p>
    </div>
    <a href="{{ route('admin.subjects.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Tambah Mata Kuliah
    </a>
</div>

<div class="glass overflow-hidden rounded-2xl shadow-2xl border border-white/60">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200/50 table-glass">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Kode</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Nama Mata Kuliah</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">SKS</th>
                    <th class="px-6 py-4 text-center text-xs font-extrabold text-gray-500 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100/50 bg-white/40">
                @foreach($subjects as $subject)
                <tr class="hover:bg-white/60 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-extrabold rounded-lg uppercase tracking-wider">{{ $subject->code }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-extrabold text-gray-900">{{ $subject->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-600">{{ $subject->sks }} SKS</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.subjects.edit', $subject) }}" class="p-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($subjects->count() == 0)
        <div class="p-12 text-center text-gray-500 font-bold italic">Belum ada data mata kuliah.</div>
    @endif
</div>
@endsection
