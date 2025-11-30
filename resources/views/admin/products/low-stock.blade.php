@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="space-y-8">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Stok Menipis & Kritis</h1>
            <p class="text-slate-500 text-sm mt-1">Daftar produk yang memerlukan restock segera untuk menghindari kehilangan penjualan.</p>
        </div>
        
        @if($products->count() > 0)
            <div class="flex items-center gap-2 px-4 py-2 bg-rose-50 border border-rose-100 rounded-lg text-rose-700">
                <span class="relative flex h-3 w-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                </span>
                <span class="text-sm font-bold">{{ $products->count() }} Produk Perlu Perhatian</span>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-48">Level Stok</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-slate-900">{{ $product->name }}</div>
                                            <div class="text-xs text-slate-500 font-mono mt-0.5">{{ $product->code }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $product->category ?? 'Umum' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 align-middle">
                                    <div class="w-full max-w-[140px]">
                                        <div class="flex justify-between items-end mb-1">
                                            <span class="text-xs font-medium {{ $product->stock == 0 ? 'text-rose-600' : 'text-amber-600' }}">
                                                {{ $product->stock == 0 ? 'Habis' : 'Tersisa' }}
                                            </span>
                                            <span class="text-lg font-bold font-mono {{ $product->stock == 0 ? 'text-rose-600' : 'text-slate-800' }}">
                                                {{ $product->stock }} <span class="text-xs text-slate-400 font-sans font-normal">/ {{ $product->unit ?? 'pcs' }}</span>
                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                            <div class="h-2 rounded-full {{ $product->stock == 0 ? 'bg-rose-500' : 'bg-amber-500' }}" 
                                                 style="width: {{ $product->stock > 5 ? '100%' : ($product->stock / 5) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 hover:text-indigo-600 hover:border-indigo-300 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                        Update Stok
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Stok Inventaris Aman!</h3>
                <p class="text-slate-500 max-w-sm mt-2">
                    Luar biasa. Tidak ada produk yang stoknya menipis atau habis saat ini.
                </p>
                <div class="mt-6">
                    <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center gap-1">
                        Lihat semua produk
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between pt-4 border-t border-slate-200">
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            <span class="font-medium">Kembali ke Dashboard</span>
        </a>
        
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition shadow-lg shadow-slate-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <span class="font-medium">Tambah Produk Baru</span>
        </a>
    </div>
</div>
@endsection