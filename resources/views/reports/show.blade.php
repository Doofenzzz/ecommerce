@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $transaction->transaction_number)

@section('content')
<div class="min-h-screen bg-slate-100 -m-4 p-6 flex justify-center items-start font-sans text-slate-800">

    <div class="w-full max-w-3xl">
        <div class="flex justify-between items-center mb-6 print:hidden">
            <a href="{{ auth()->user()->isAdmin() ? route('admin.reports.index') : route('cashier.history') }}" 
               class="flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
            <button onclick="window.print()" class="flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all font-semibold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak Struk
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200 print:shadow-none print:border-none print:rounded-none print:w-full">
            
            <div class="bg-slate-50 border-b border-slate-200 p-8 text-center relative overflow-hidden print:bg-white print:border-none print:pb-4">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -mt-16 w-64 h-64 bg-indigo-50 rounded-full opacity-50 print:hidden"></div>
                
                <div class="relative">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl mb-4 print:hidden">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">TokoKu Official</h1>
                    <p class="text-slate-500 text-sm mt-1">Jl. Contoh Bisnis No. 123, Kota Besar</p>
                    
                    <div class="mt-6 inline-block bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider print:border-black print:bg-transparent print:text-black">
                        ✓ Pembayaran Lunas
                    </div>
                </div>
            </div>

            <div class="p-8 pb-0 print:p-0">
                <div class="grid grid-cols-2 gap-y-4 gap-x-8 text-sm">
                    <div class="flex flex-col">
                        <span class="text-slate-500 text-xs uppercase tracking-wider mb-1">No. Transaksi</span>
                        <span class="font-mono font-bold text-slate-800 text-base">#{{ $transaction->transaction_number }}</span>
                    </div>
                    <div class="flex flex-col text-right">
                        <span class="text-slate-500 text-xs uppercase tracking-wider mb-1">Waktu Transaksi</span>
                        <span class="font-mono font-bold text-slate-800">{{ $transaction->created_at->format('d/m/Y') }}</span>
                        <span class="text-xs text-slate-400 font-mono">{{ $transaction->created_at->format('H:i') }} WIB</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-slate-500 text-xs uppercase tracking-wider mb-1">Kasir</span>
                        <span class="font-bold text-slate-800">{{ $transaction->user->name }}</span>
                    </div>
                    <div class="flex flex-col text-right">
                        <span class="text-slate-500 text-xs uppercase tracking-wider mb-1">Metode Bayar</span>
                        <span class="font-bold text-slate-800">Tunai / Cash</span>
                    </div>
                </div>
            </div>

            <div class="relative flex items-center justify-center my-8 print:my-4">
                <div class="w-full border-t-2 border-dashed border-slate-200 print:border-slate-400"></div>
                <div class="absolute left-0 -ml-2 w-4 h-4 bg-slate-100 rounded-full print:hidden"></div>
                <div class="absolute right-0 -mr-2 w-4 h-4 bg-slate-100 rounded-full print:hidden"></div>
            </div>

            <div class="px-8 print:px-0">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="pb-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Item</th>
                            <th class="pb-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Qty</th>
                            <th class="pb-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Harga</th>
                            <th class="pb-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dashed divide-slate-100 print:divide-slate-300">
                        @foreach($transaction->details as $detail)
                            <tr>
                                <td class="py-4 align-top">
                                    <p class="font-bold text-slate-800 text-sm">{{ $detail->product->name }}</p>
                                    <p class="text-xs text-slate-400 font-mono mt-0.5">{{ $detail->product->code }}</p>
                                </td>
                                <td class="py-4 align-top text-right text-sm font-medium text-slate-600">
                                    x{{ $detail->quantity }}
                                </td>
                                <td class="py-4 align-top text-right text-sm font-mono text-slate-600">
                                    {{ number_format($detail->price, 0, ',', '.') }}
                                </td>
                                <td class="py-4 align-top text-right text-sm font-mono font-bold text-slate-800">
                                    {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-50 p-8 mt-4 border-t border-slate-200 print:bg-transparent print:border-t-2 print:border-black print:mt-2">
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-slate-600">
                        <span class="text-sm">Total Belanja</span>
                        <span class="font-mono font-bold text-slate-800">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-600">
                        <span class="text-sm">Uang Dibayar</span>
                        <span class="font-mono font-medium">Rp {{ number_format($transaction->paid, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-slate-200 my-2 pt-2 flex justify-between items-center print:border-black">
                        <span class="text-base font-bold text-slate-800">Kembalian</span>
                        <span class="text-xl font-bold font-mono text-emerald-600 print:text-black">
                            Rp {{ number_format($transaction->change, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                
                <div class="text-center mt-8 pt-6 border-t border-dashed border-slate-200 print:mt-4 print:pt-4">
                    <p class="text-xs text-slate-400 italic">Terima kasih telah berbelanja di TokoKu.</p>
                    <p class="text-[10px] text-slate-300 mt-1 uppercase">Barang yang sudah dibeli tidak dapat ditukar</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    @page {
        margin: 0;
        size: auto;
    }
    body {
        background-color: white !important;
        color: black !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    /* Hide layout elements like navbar/sidebar */
    nav, header, footer, .sidebar, .no-print {
        display: none !important;
    }
    
    /* Reset container */
    .min-h-screen {
        min-height: auto !important;
        padding: 0 !important;
        margin: 0 !important;
        display: block !important;
    }
    .max-w-3xl {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
    }
    
    /* Ensure colors print if user allows, but fallback to strong contrasts */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
</style>
@endsection