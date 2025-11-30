@extends('layouts.app')

@section('title', 'Kasir Pro')

@section('content')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div x-data="cashierApp()" class="min-h-screen bg-slate-50 font-sans text-slate-800 -m-4 p-4 lg:p-6">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Transaksi Penjualan</h1>
            <p class="text-slate-500 text-sm">Kelola transaksi pelanggan dengan cepat.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-200 text-right">
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Transaksi Hari Ini</p>
                <p class="text-lg font-bold text-indigo-600 font-mono">Rp 0</p> {{-- Placeholder, bisa diisi data real --}}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-[calc(100vh-140px)]">
        
        <div class="lg:col-span-7 flex flex-col gap-4 h-full">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" x-model="searchQuery" @input="searchProduct" 
                           placeholder="Cari nama produk, SKU, atau scan barcode..."
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none text-slate-800 placeholder-slate-400"
                           autofocus>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto no-scrollbar pr-1">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pb-20">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="addToCart(product)" 
                             class="group bg-white rounded-2xl p-4 border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-300 cursor-pointer transition-all duration-200 flex flex-col justify-between h-full relative overflow-hidden">
                            
                            <div x-show="product.stock <= 5" class="absolute top-0 right-0 bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-1 rounded-bl-lg">
                                Low Stock
                            </div>

                            <div class="mb-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h3 class="font-bold text-slate-800 leading-snug group-hover:text-indigo-600 transition-colors" x-text="product.name"></h3>
                                <p class="text-xs text-slate-400 mt-1 font-mono" x-text="product.code"></p>
                            </div>
                            
                            <div class="flex justify-between items-end border-t border-slate-100 pt-3 mt-auto">
                                <div class="text-xs text-slate-500">
                                    Stok: <span class="font-medium text-slate-800" x-text="product.stock"></span>
                                </div>
                                <div class="font-mono font-bold text-indigo-600" x-text="formatRupiah(product.selling_price)"></div>
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="filteredProducts.length === 0">
                        <div class="col-span-full flex flex-col items-center justify-center py-12 text-slate-400">
                            <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <p>Produk tidak ditemukan.</p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 flex flex-col h-full bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden relative">
            <div class="p-5 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                <h2 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Current Order
                </h2>
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full" x-text="cart.length + ' Items'"></span>
            </div>

            <div class="flex-1 overflow-y-auto no-scrollbar p-4 space-y-3">
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex items-center justify-between group p-2 hover:bg-slate-50 rounded-xl transition-colors border border-transparent hover:border-slate-100">
                        <div class="flex-1 min-w-0 pr-4">
                            <h4 class="font-bold text-slate-800 truncate text-sm" x-text="item.name"></h4>
                            <p class="text-xs text-slate-400 font-mono mt-0.5" x-text="formatRupiah(item.price)"></p>
                        </div>
                        
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-lg px-2 py-1 shadow-sm">
                            <button @click="updateQty(index, item.quantity - 1)" 
                                    class="w-6 h-6 flex items-center justify-center rounded-md bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                            </button>
                            <input type="number" x-model.number="item.quantity" @input="updateQty(index, item.quantity)"
                                   class="w-8 text-center text-sm font-bold text-slate-800 focus:outline-none border-none p-0">
                            <button @click="updateQty(index, item.quantity + 1)" 
                                    class="w-6 h-6 flex items-center justify-center rounded-md bg-indigo-50 hover:bg-indigo-100 text-indigo-600 transition">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="text-right pl-4 w-24">
                            <p class="font-bold font-mono text-slate-800 text-sm" x-text="formatRupiah(item.subtotal)"></p>
                            <button @click="removeFromCart(index)" class="text-xs text-red-500 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity mt-1">Hapus</button>
                        </div>
                    </div>
                </template>

                <template x-if="cart.length === 0">
                    <div class="h-full flex flex-col items-center justify-center text-slate-400 space-y-3 opacity-60">
                        <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <p class="text-sm">Keranjang belanja kosong</p>
                    </div>
                </template>
            </div>

            <div class="bg-white border-t border-slate-200 p-6 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-10">
                
                <div class="flex justify-between items-end mb-6">
                    <span class="text-slate-500 font-medium">Total Tagihan</span>
                    <span class="text-3xl font-extrabold text-slate-900 tracking-tight font-mono" x-text="formatRupiah(totalAmount)"></span>
                </div>

                <div class="space-y-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 font-bold">Rp</span>
                        </div>
                        <input type="number" x-model.number="paidAmount" 
                               placeholder="Masukkan nominal..."
                               class="w-full pl-12 pr-4 py-3 text-lg font-bold font-mono border-2 border-slate-200 rounded-xl focus:ring-0 focus:border-indigo-600 transition-colors bg-slate-50">
                    </div>

                    <div class="grid grid-cols-4 gap-2">
                        <button @click="paidAmount = totalAmount" class="text-xs font-semibold py-2 px-1 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition">Pas</button>
                        <button @click="paidAmount = 20000" class="text-xs font-semibold py-2 px-1 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition">20k</button>
                        <button @click="paidAmount = 50000" class="text-xs font-semibold py-2 px-1 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition">50k</button>
                        <button @click="paidAmount = 100000" class="text-xs font-semibold py-2 px-1 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition">100k</button>
                    </div>

                    <div class="flex justify-between items-center py-3 border-t border-dashed border-slate-300">
                        <span class="text-sm font-semibold text-slate-600">Kembalian</span>
                        <span class="text-xl font-bold font-mono" 
                              :class="changeAmount >= 0 ? 'text-emerald-600' : 'text-red-500'" 
                              x-text="formatRupiah(Math.abs(changeAmount))"></span>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <button @click="resetTransaction" 
                                class="col-span-1 py-3.5 border border-slate-300 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition active:scale-95">
                            Batal
                        </button>
                        <button @click="saveTransaction" 
                                :disabled="cart.length === 0 || changeAmount < 0"
                                class="col-span-2 py-3.5 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all active:scale-95 disabled:bg-slate-300 disabled:shadow-none disabled:cursor-not-allowed flex justify-center items-center gap-2">
                            <span>Bayar & Cetak</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function cashierApp() {
    return {
        products: @json($products),
        searchQuery: '',
        cart: [],
        paidAmount: '',
        
        get filteredProducts() {
            if (!this.searchQuery) return this.products;
            const query = this.searchQuery.toLowerCase();
            return this.products.filter(p => 
                p.name.toLowerCase().includes(query) || 
                p.code.toLowerCase().includes(query)
            );
        },
        
        get totalAmount() {
            // FIX: Tambahkan Number() di sini untuk memastikan hitungannya matematika, bukan teks
            return this.cart.reduce((sum, item) => sum + Number(item.subtotal), 0);
        },
        
        get changeAmount() {
            const paid = this.paidAmount === '' ? 0 : Number(this.paidAmount); // Pastikan number
            return paid - this.totalAmount;
        },
        
        addToCart(product) {
            const existingItem = this.cart.find(item => item.product_id === product.id);
            
            // FIX: Konversi harga dari database (yg mungkin string) ke Number
            const price = Number(product.selling_price);
            
            if (existingItem) {
                if (existingItem.quantity < product.stock) {
                    existingItem.quantity++;
                    // Update subtotal
                    existingItem.subtotal = existingItem.quantity * existingItem.price;
                } else {
                    alert('Stok maksimal tercapai');
                }
            } else {
                this.cart.push({
                    product_id: product.id,
                    name: product.name,
                    code: product.code,
                    price: price, // Simpan sebagai angka murni
                    quantity: 1,
                    stock: product.stock,
                    subtotal: price // Awal masuk, subtotal = harga
                });
            }
        },
        
        updateQty(index, newQty) {
            const item = this.cart[index];
            if (newQty < 1) {
                this.removeFromCart(index);
                return;
            }
            if (newQty > item.stock) {
                alert('Stok tidak mencukupi');
                return;
            }
            item.quantity = newQty;
            // FIX: Pastikan perkalian aman
            item.subtotal = item.quantity * Number(item.price);
        },
        
        removeFromCart(index) {
            this.cart.splice(index, 1);
        },
        
        async saveTransaction() {
            if (this.cart.length === 0) return;
            if (this.changeAmount < 0) return;

            const btn = document.activeElement;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="animate-spin">↻</span> Memproses...';
            btn.disabled = true;

            try {
                const response = await fetch('{{ route("cashier.transaction.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        items: this.cart,
                        total: this.totalAmount,
                        paid: this.paidAmount,
                        change: this.changeAmount
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert('Transaksi Sukses! Kembalian: ' + this.formatRupiah(this.changeAmount));
                    this.resetTransaction();
                } else {
                    alert('Gagal: ' + data.message);
                }
            } catch (error) {
                alert('Error sistem: ' + error.message);
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        },
        
        resetTransaction() {
            this.cart = [];
            this.paidAmount = '';
            this.searchQuery = '';
        },
        
        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number); 
        }
    }
}
</script>
@endsection