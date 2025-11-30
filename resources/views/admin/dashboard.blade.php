@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-slate-500 text-sm mt-1">Berikut adalah ringkasan performa toko Anda hari ini.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 bg-white border border-slate-200 rounded-full text-xs font-semibold text-slate-600 shadow-sm">
                Status Sistem: <span class="text-emerald-500">● Online</span>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:border-indigo-300 transition-colors">
            <div class="relative z-10">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Produk</p>
                <h3 class="text-2xl font-bold text-slate-800 font-mono">{{ number_format($totalProducts) }}</h3>
                <p class="text-xs text-slate-400 mt-2">Item terdaftar di database</p>
            </div>
            <div class="absolute right-3 top-3 p-2 bg-indigo-50 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:border-emerald-300 transition-colors">
            <div class="relative z-10">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Transaksi Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-800 font-mono">{{ number_format($todayTransactions) }}</h3>
                <p class="text-xs text-slate-400 mt-2">Penjualan berhasil</p>
            </div>
            <div class="absolute right-3 top-3 p-2 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:border-purple-300 transition-colors">
            <div class="relative z-10">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Omzet Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-800 font-mono">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                <p class="text-xs text-slate-400 mt-2">Pendapatan kotor</p>
            </div>
            <div class="absolute right-3 top-3 p-2 bg-purple-50 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 relative overflow-hidden group hover:border-amber-300 transition-colors">
            <div class="relative z-10">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Stok Menipis</p>
                <div class="flex items-end gap-2">
                    <h3 class="text-2xl font-bold {{ $lowStockProducts > 0 ? 'text-amber-600' : 'text-slate-800' }} font-mono">{{ $lowStockProducts }}</h3>
                    @if($lowStockProducts > 0)
                        <span class="text-[10px] font-bold bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full mb-1.5 animate-pulse">Perlu Restock</span>
                    @endif
                </div>
                
                @if($lowStockProducts > 0)
                    <a href="{{ route('admin.products.low-stock') }}" class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 hover:text-amber-700 mt-2 hover:underline">
                        Lihat Detail
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </a>
                @else
                    <p class="text-xs text-slate-400 mt-2">Stok aman</p>
                @endif
            </div>
            <div class="absolute right-3 top-3 p-2 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Transaksi Terakhir
                    </h3>
                    <a href="{{ route('admin.reports.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                        Lihat Semua
                    </a>
                </div>
                
                <div class="overflow-x-auto flex-1">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Transaksi</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kasir</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($recentTransactions as $transaction)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-700 font-mono">{{ $transaction->transaction_number }}</span>
                                            <span class="text-xs text-slate-400">{{ $transaction->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                                {{ substr($transaction->user->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm text-slate-600">{{ $transaction->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 whitespace-nowrap text-right">
                                        <span class="text-sm font-bold text-slate-800 font-mono">
                                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center text-slate-400">
                                        <p class="text-sm">Belum ada transaksi hari ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Aksi Cepat
                </h3>
                
                <div class="space-y-3">
                    <a href="{{ route('cashier.transaction') }}" class="group flex items-center p-3 bg-slate-50 rounded-xl hover:bg-indigo-50 hover:shadow-sm border border-transparent hover:border-indigo-100 transition-all">
                        <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-bold text-slate-800 group-hover:text-indigo-700">Kasir / Transaksi</h4>
                            <p class="text-xs text-slate-500">Mulai penjualan baru</p>
                        </div>
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <a href="{{ route('admin.products.create') }}" class="group flex items-center p-3 bg-slate-50 rounded-xl hover:bg-blue-50 hover:shadow-sm border border-transparent hover:border-blue-100 transition-all">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-bold text-slate-800 group-hover:text-blue-700">Tambah Produk</h4>
                            <p class="text-xs text-slate-500">Input item ke inventory</p>
                        </div>
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <a href="{{ route('admin.reports.index') }}" class="group flex items-center p-3 bg-slate-50 rounded-xl hover:bg-purple-50 hover:shadow-sm border border-transparent hover:border-purple-100 transition-all">
                        <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-bold text-slate-800 group-hover:text-purple-700">Laporan Penjualan</h4>
                            <p class="text-xs text-slate-500">Analisis performa toko</p>
                        </div>
                        <svg class="w-4 h-4 ml-auto text-slate-300 group-hover:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-2xl p-5 text-white shadow-lg shadow-indigo-200">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-white/20 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm opacity-90">Tahukah Anda?</h4>
                        <p class="text-xs mt-1 text-blue-100 leading-relaxed">
                            Melihat laporan penjualan harian secara rutin dapat membantu Anda mengatur stok lebih efisien.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection