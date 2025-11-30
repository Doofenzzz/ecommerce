@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div x-data="productForm()" class="max-w-5xl mx-auto">
    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Produk</h1>
            <p class="text-slate-500 text-sm mt-1">Isi informasi lengkap untuk menambahkan item baru ke inventaris.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:p-8">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        Informasi Dasar
                    </h2>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Kopi Susu Gula Aren"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none @error('name') border-red-500 bg-red-50 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kode / SKU <span class="text-red-500">*</span></label>
                                <div class="relative flex items-center">
                                    <input type="text" name="code" x-model="code" required placeholder="SCAN-001"
                                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none font-mono uppercase">
                                    <button type="button" @click="generateCode" class="absolute right-2 p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Generate Random Code">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    </button>
                                </div>
                                @error('code')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                    </div>
                                    <input type="text" name="category" value="{{ old('category') }}" placeholder="Makanan, Minuman, Snack..."
                                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:p-8">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        Harga & Keuntungan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Beli / Modal</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="purchase_price" x-model="purchasePrice" min="0" placeholder="0"
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none font-mono">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Jual <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="selling_price" x-model="sellingPrice" min="0" required placeholder="0"
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none font-mono">
                            </div>
                             @error('selling_price')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-500">Estimasi Keuntungan:</span>
                        <div class="text-right">
                            <p class="font-bold font-mono text-lg" :class="profit >= 0 ? 'text-emerald-600' : 'text-red-500'" x-text="formatRupiah(profit)">Rp 0</p>
                            <p class="text-xs text-slate-400" x-show="margin > 0" x-text="'Margin: ' + margin + '%'">Margin: 0%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        Inventaris
                    </h2>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none font-mono">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Satuan Unit <span class="text-red-500">*</span></label>
                            <input type="text" name="unit" value="{{ old('unit', 'pcs') }}" required placeholder="pcs, kg, box"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Produk</label>
                            <div class="relative">
                                <select name="is_active" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none appearance-none">
                                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>🟢 Aktif (Dijual)</option>
                                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>🔴 Non-aktif (Arsip)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-95 mb-3 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                        Simpan Produk
                    </button>
                    
                    <a href="{{ route('admin.products.index') }}" class="w-full py-3.5 px-4 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all flex justify-center text-center">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function productForm() {
    return {
        code: '{{ old('code') }}',
        purchasePrice: '{{ old('purchase_price') }}',
        sellingPrice: '{{ old('selling_price') }}',
        
        generateCode() {
            // Generate Random SKU: PRD + Timestamp + Random Number
            const random = Math.floor(100 + Math.random() * 900);
            this.code = 'PRD-' + Date.now().toString().substr(-4) + '-' + random;
        },
        
        get profit() {
            const sell = Number(this.sellingPrice) || 0;
            const buy = Number(this.purchasePrice) || 0;
            return sell - buy;
        },

        get margin() {
            const sell = Number(this.sellingPrice) || 0;
            const profit = this.profit;
            if(sell <= 0) return 0;
            return ((profit / sell) * 100).toFixed(1);
        },

        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0 
            }).format(number);
        }
    }
}
</script>
@endsection