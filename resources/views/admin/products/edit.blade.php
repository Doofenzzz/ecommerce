<!-- resources/views/admin/products/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div x-data="productEditForm()" class="max-w-5xl mx-auto">
    
    <!-- Header with Breadcrumb Style -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                <a href="{{ route('admin.products.index') }}" class="hover:text-indigo-600 transition-colors">Produk</a>
                <span>/</span>
                <span>Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                Edit: {{ $product->name }}
                <span class="px-2.5 py-0.5 rounded-full text-xs border {{ $product->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                    {{ $product->is_active ? 'Aktif' : 'Non-aktif' }}
                </span>
            </h1>
        </div>
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors bg-white px-4 py-2 rounded-lg border border-slate-200 hover:bg-slate-50">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- COLUMN 1: General Info (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Basic Info Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:p-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -mr-16 -mt-16 opacity-50 pointer-events-none"></div>
                    
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2 relative z-10">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        Informasi Utama
                    </h2>

                    <div class="space-y-6 relative z-10">
                        <!-- Product Name -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none @error('name') border-red-500 bg-red-50 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Product Code -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kode / SKU <span class="text-red-500">*</span></label>
                                <input type="text" name="code" value="{{ old('code', $product->code) }}" required
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none font-mono uppercase">
                                @error('code')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                                <input type="text" name="category" value="{{ old('category', $product->category) }}" placeholder="Makanan, Minuman..."
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 lg:p-8">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        Harga & Margin
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Purchase Price -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Beli / Modal</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="purchase_price" x-model="purchasePrice" min="0"
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none font-mono">
                            </div>
                        </div>

                        <!-- Selling Price -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Jual <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="number" name="selling_price" x-model="sellingPrice" min="0" required
                                       class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none font-mono">
                            </div>
                            @error('selling_price')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Profit Calculator -->
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-500">Estimasi Keuntungan:</span>
                        <div class="text-right">
                            <p class="font-bold font-mono text-lg" :class="profit >= 0 ? 'text-emerald-600' : 'text-red-500'" x-text="formatRupiah(profit)">Rp 0</p>
                            <p class="text-xs text-slate-400" x-show="margin != 0" x-text="'Margin: ' + margin + '%'">Margin: 0%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMN 2: Inventory & Status (1/3 width) -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Inventory Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        Inventaris
                    </h2>

                    <div class="space-y-5">
                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Stok Saat Ini <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none font-mono text-lg font-bold text-slate-700">
                            <p class="text-xs text-slate-400 mt-1">Ubah angka ini untuk update stok.</p>
                        </div>

                        <!-- Unit -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Satuan Unit</label>
                            <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" required placeholder="pcs, kg..."
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all outline-none">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Produk</label>
                            <div class="relative">
                                <select name="is_active" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>🟢 Aktif (Dijual)</option>
                                    <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>🔴 Non-aktif (Arsip)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Last Update Info (Optional Meta) -->
                <div class="text-center">
                    <p class="text-xs text-slate-400">Terakhir diperbarui: {{ $product->updated_at->diffForHumans() }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-95 mb-3 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        Simpan Perubahan
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
function productEditForm() {
    return {
        // Init data dengan nilai dari database
        purchasePrice: '{{ old('purchase_price', $product->purchase_price) }}',
        sellingPrice: '{{ old('selling_price', $product->selling_price) }}',
        
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