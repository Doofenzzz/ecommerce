@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Buat Akun Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Isi formulir di bawah untuk menambahkan pengguna sistem.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" x-data="{ showPassword: false }">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    Profil Pengguna
                </h2>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none @error('name') border-red-500 bg-red-50 @enderror">
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@email.com"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none @error('email') border-red-500 bg-red-50 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    Keamanan & Akses
                </h2>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Role / Jabatan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <select name="role" class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none appearance-none cursor-pointer">
                                <option value="cashier" {{ old('role') === 'cashier' ? 'selected' : '' }}>Kasir Staff</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-semibold text-slate-700">Password</label>
                            <button type="button" @click="showPassword = !showPassword" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                                <span x-text="showPassword ? 'Sembunyikan' : 'Lihat'"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" name="password" required placeholder="••••••••"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none @error('password') border-red-500 bg-red-50 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" required placeholder="Ulangi password"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition">
                Batal
            </a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                Simpan User
            </button>
        </div>
    </form>
</div>
@endsection