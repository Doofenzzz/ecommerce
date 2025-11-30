<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'TokoKu') }} - @yield('title', 'Dashboard')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-white text-slate-800 antialiased" x-data="{ sidebarOpen: false }">
    
    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div class="md:hidden flex items-center justify-between bg-slate-900/95 text-slate-100 p-4">
            <div class="flex items-center gap-2 font-bold text-lg">
                <div class="bg-indigo-500 p-1.5 rounded-lg shadow-lg shadow-indigo-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                TokoKu
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="text-slate-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950/95 text-slate-200 transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 flex flex-col shadow-2xl md:shadow-none backdrop-blur">
            
            <div class="h-16 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/80">
                <div class="flex items-center gap-3 font-bold text-xl text-white tracking-tight drop-shadow-sm">
                    <div class="bg-indigo-500 p-1.5 rounded-lg shadow-lg shadow-indigo-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    TokoKu POS
                </div>
                <button @click="sidebarOpen = false" class="md:hidden ml-auto text-slate-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="p-4">
                <div class="flex items-center gap-3 bg-slate-900/70 p-3 rounded-xl border border-slate-800/60 shadow-inner">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 capitalize truncate">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Kasir Staff' }}</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto py-2 px-3 space-y-6">
                @php
                    $navBase = 'group flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200';
                    $navActive = $navBase.' bg-indigo-600 text-white shadow-lg shadow-indigo-500/30 ring-1 ring-indigo-400/60';
                    $navInactive = $navBase.' text-slate-300 hover:text-white hover:bg-white/5';
                    $iconWrap = 'flex items-center justify-center h-9 w-9 rounded-lg bg-white/10 text-white/80 group-hover:bg-white/15';
                @endphp

                @if(auth()->user()->isAdmin())
                    <div class="space-y-1">
                        @php $isDashboard = request()->routeIs('admin.dashboard'); @endphp
                        <a href="{{ route('admin.dashboard') }}" class="{{ $isDashboard ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </span>
                            <span class="flex-1">Dashboard</span>
                            @if($isDashboard)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>
                    </div>

                    <div class="space-y-1">
                        <p class="px-3 text-[11px] font-semibold text-slate-500 uppercase tracking-[0.14em] mt-5">Master Data</p>
                        @php $isProduct = request()->routeIs('admin.products.*'); @endphp
                        <a href="{{ route('admin.products.index') }}" class="{{ $isProduct ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </span>
                            <span class="flex-1">Produk</span>
                            @if($isProduct)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>

                        @php $isUser = request()->routeIs('admin.users.*'); @endphp
                        <a href="{{ route('admin.users.index') }}" class="{{ $isUser ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <span class="flex-1">Kelola User</span>
                            @if($isUser)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>
                    </div>

                    <div class="space-y-1">
                        <p class="px-3 text-[11px] font-semibold text-slate-500 uppercase tracking-[0.14em] mt-5">Operasional</p>
                        @php $isKasir = request()->routeIs('cashier.transaction'); @endphp
                        <a href="{{ route('cashier.transaction') }}" class="{{ $isKasir ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="flex-1">Transaksi Kasir</span>
                            @if($isKasir)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>

                        @php $isReport = request()->routeIs('admin.reports.*'); @endphp
                        <a href="{{ route('admin.reports.index') }}" class="{{ $isReport ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </span>
                            <span class="flex-1">Laporan</span>
                            @if($isReport)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>
                    </div>
                @else
                    <div class="space-y-1">
                        <p class="px-3 text-[11px] font-semibold text-slate-500 uppercase tracking-[0.14em]">Kasir</p>

                        @php $isKasir = request()->routeIs('cashier.transaction'); @endphp
                        <a href="{{ route('cashier.transaction') }}" class="{{ $isKasir ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="flex-1">Transaksi</span>
                            @if($isKasir)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>
                        
                        @php $isHistory = request()->routeIs('cashier.history*'); @endphp
                        <a href="{{ route('cashier.history') }}" class="{{ $isHistory ? $navActive : $navInactive }}">
                            <span class="{{ $iconWrap }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span class="flex-1">Riwayat</span>
                            @if($isHistory)
                                <span class="w-2 h-2 rounded-full bg-white/90 shadow ring-2 ring-white/40"></span>
                            @endif
                        </a>
                    </div>
                @endif
            </nav>

            <div class="p-4 border-t border-slate-800/80">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-slate-400 rounded-lg hover:text-white hover:bg-red-500/15 hover:text-red-300 transition-colors group">
                        <svg class="w-5 h-5 group-hover:text-red-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
             class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

        <div class="flex-1 flex flex-col h-screen overflow-hidden bg-gradient-to-br from-white via-slate-50 to-indigo-50/40">
            
            <header class="h-16 bg-white/90 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-6 z-10 sticky top-0 shadow-sm">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">
                        @yield('header', 'Overview')
                    </h2>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-100 rounded-full border border-slate-200">
                        <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-semibold text-slate-600 font-mono">{{ now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6 scroll-smooth">
                <div class="max-w-7xl mx-auto">
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                             class="mb-6 flex items-center p-4 text-sm text-emerald-800 border border-emerald-200 rounded-xl bg-emerald-50 shadow-sm" role="alert">
                            <svg class="flex-shrink-0 inline w-5 h-5 mr-3 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium">Berhasil!</span>&nbsp; {{ session('success') }}
                            <button @click="show = false" class="ml-auto text-emerald-600 hover:text-emerald-800"><span class="sr-only">Close</span>×</button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" 
                             class="mb-6 flex items-center p-4 text-sm text-red-800 border border-red-200 rounded-xl bg-red-50 shadow-sm" role="alert">
                            <svg class="flex-shrink-0 inline w-5 h-5 mr-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium">Error!</span>&nbsp; {{ session('error') }}
                            <button @click="show = false" class="ml-auto text-red-600 hover:text-red-800"><span class="sr-only">Close</span>×</button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
