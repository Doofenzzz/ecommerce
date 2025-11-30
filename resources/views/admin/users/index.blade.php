@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Pengguna</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola akses staff, admin, dan kasir toko.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all active:scale-95">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            Tambah User Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User Profile</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Akun</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $user->role == 'admin' ? 'from-purple-500 to-indigo-600' : 'from-blue-400 to-cyan-500' }} flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-white">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-slate-900">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                        Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        Kasir Staff
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-2.5 w-2.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $user->is_active ? 'bg-emerald-400' : 'bg-rose-400' }} opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $user->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    </span>
                                    <span class="text-sm font-medium {{ $user->is_active ? 'text-emerald-700' : 'text-rose-700' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Non-aktif' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all" 
                                                    title="{{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                @if($user->is_active)
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                @endif
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus Permanen">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-2 py-1 bg-slate-100 text-slate-400 text-xs font-bold rounded">YOU</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection