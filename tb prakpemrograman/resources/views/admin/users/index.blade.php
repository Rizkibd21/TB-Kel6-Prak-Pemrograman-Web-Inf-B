@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">
            Manajemen Pengguna 
            @if(request('role'))
                <span class="text-indigo-600">- {{ ucfirst(request('role')) }}</span>
            @endif
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Kelola data mahasiswa, dosen, dan administrator.</p>
    </div>
    <div class="flex gap-3">
        <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="px-6 py-3 bg-white/60 hover:bg-white text-emerald-700 font-extrabold rounded-xl transition border border-white/60 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Import CSV
        </button>
        <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Pengguna
        </a>
    </div>
</div>

<!-- Import Modal (Glassmorphism) -->
<div id="importModal" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="glass-card w-full max-w-md p-8 animate-float">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900">Import Users (CSV)</h3>
            <p class="text-sm font-bold text-gray-500 mt-2">
                Format: Nama, Email, NIM/NIDN, Role, Password
            </p>
        </div>
        
        <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="p-4 bg-white/40 border border-white/60 rounded-xl text-center cursor-pointer hover:bg-white/60 transition relative">
                <input type="file" name="file" class="absolute inset-0 opacity-0 cursor-pointer" id="file-input" required onchange="document.getElementById('file-name').innerText = this.files[0].name">
                <p id="file-name" class="text-sm font-bold text-emerald-700">Pilih file CSV...</p>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="flex-1 px-4 py-3 bg-white/60 text-gray-700 font-extrabold rounded-xl hover:bg-white transition border border-white/60">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-emerald-600 text-white font-extrabold rounded-xl hover:bg-emerald-700 transition shadow-xl shadow-emerald-100">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<div class="glass overflow-hidden rounded-2xl shadow-2xl border border-white/60">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200/50 table-glass">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Pengguna</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Kontak & ID</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Role</th>
                    <th class="px-6 py-4 text-center text-xs font-extrabold text-gray-500 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100/50 bg-white/40">
                @forelse($users as $user)
                <tr class="hover:bg-white/60 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($user->avatar)
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm mr-3" src="{{ asset('storage/'.$user->avatar) }}" alt="">
                            @else
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-extrabold border-2 border-white shadow-sm mr-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-extrabold text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-xs font-extrabold text-gray-700 mb-1">ID: {{ $user->nidn ?? $user->nim ?? '-' }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $user->phone ?? 'No Phone' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-extrabold rounded-full uppercase tracking-wider
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : '' }}
                            {{ $user->role === 'dosen' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $user->role === 'mahasiswa' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2-2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 font-bold italic">Tidak ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50/30">
        {{ $users->links() }}
    </div>
</div>
@endsection
