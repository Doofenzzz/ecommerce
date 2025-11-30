@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')
<div class="min-h-screen bg-slate-50/50 -m-4 p-6 font-sans text-slate-800">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Riwayat Penjualan</h1>
            <p class="text-slate-500 text-sm mt-1">Pantau performa penjualan dan detail transaksi.</p>
        </div>
        
        <div class="relative overflow-hidden bg-white border border-slate-200 rounded-2xl p-5 shadow-sm min-w-[280px]">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-50 rounded-full blur-2xl opacity-50"></div>
            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-indigo-600 font-mono">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </h3>
                    <p class="text-xs text-slate-400 mt-2">Periode yang dipilih</p>
                </div>
                <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                
                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-1">Dari Tanggal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full pl-9 pr-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-slate-700 shadow-sm">
                    </div>
                </div>
                
                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-1">Sampai Tanggal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full pl-9 pr-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-slate-700 shadow-sm">
                    </div>
                </div>
                
                @if(auth()->user()->isAdmin())
                    <div class="md:col-span-3">
                        <label class="block text-xs font-semibold text-slate-500 mb-1.5 ml-1">Filter Kasir</label>
                        <div class="relative">
                            <select name="cashier_id" class="w-full pl-3 pr-8 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white text-slate-700 shadow-sm appearance-none">
                                <option value="">Semua Kasir</option>
                                @foreach($cashiers as $cashier)
                                    <option value="{{ $cashier->id }}" {{ request('cashier_id') == $cashier->id ? 'selected' : '' }}>
                                        {{ $cashier->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="md:col-span-3"></div>
                @endif
                
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Terapkan
                    </button>
                    @if(request()->hasAny(['date_from', 'date_to', 'cashier_id']))
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.reports.index') : route('cashier.history') }}" 
                           class="px-4 py-2 bg-white border border-slate-300 text-slate-600 text-sm font-medium rounded-lg hover:bg-slate-50 transition shadow-sm" title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Transaksi</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kasir</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse($transactions as $transaction)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-slate-700 font-mono">
                                        {{ $transaction->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full font-mono">
                                        {{ $transaction->created_at->format('H:i') }}
                                    </span>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-600 font-mono bg-slate-50 border border-slate-200 px-2 py-1 rounded">
                                    #{{ $transaction->transaction_number }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold ring-2 ring-white shadow-sm">
                                        {{ substr($transaction->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-slate-900">{{ $transaction->user->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $transaction->user->email ?? 'Cashier' }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-900 font-mono">
                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ auth()->user()->isAdmin() ? route('admin.reports.show', $transaction) : route('cashier.history.show', $transaction) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <div class="bg-slate-50 p-4 rounded-full mb-3">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-base font-medium text-slate-600">Tidak ada transaksi ditemukan</p>
                                    <p class="text-sm mt-1">Coba sesuaikan filter tanggal pencarian Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection