@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Inventaris Produk</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola katalog, harga, dan stok barang toko Anda.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all active:scale-95">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            
            <div class="md:col-span-5 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama produk atau SKU..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
            </div>

            <div class="md:col-span-3 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <select name="category" class="w-full pl-10 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none appearance-none cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            <div class="md:col-span-4 flex gap-2">
                <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white font-medium rounded-xl hover:bg-slate-700 transition shadow-md">
                    Filter
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-50 transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Info Produk</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500">
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

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-700 font-mono">
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                                        {{ $product->stock < 5 
                                            ? 'bg-red-50 text-red-700 border-red-100' 
                                            : ($product->stock < 10 ? 'bg-amber-50 text-amber-700 border-amber-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100') }}">
                                        {{ $product->stock }} {{ $product->unit ?? 'pcs' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full {{ $product->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span class="text-sm text-slate-600 font-medium">
                                        {{ $product->is_active ? 'Aktif' : 'Arsip' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-sm transition-all" 
                                       title="Edit Produk">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}? Data tidak dapat dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-red-300 hover:text-red-600 hover:shadow-sm transition-all"
                                                title="Hapus Produk">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="bg-slate-50 p-4 rounded-full mb-3">
                                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-slate-900">Belum ada produk</h3>
                                    <p class="text-sm mt-1 max-w-sm mx-auto">Produk yang Anda tambahkan akan muncul di sini. Mulai dengan menambahkan produk pertama Anda.</p>
                                    <a href="{{ route('admin.products.create') }}" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                        + Tambah Produk Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="bg-slate-50 border-t border-slate-200 px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection