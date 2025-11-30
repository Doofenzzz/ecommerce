<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::where('is_active', true)->count();
        
        $todayTransactions = Transaction::whereDate('created_at', today())->count();
        
        $todayRevenue = Transaction::whereDate('created_at', today())->sum('total');
        
        $lowStockProducts = Product::where('is_active', true)
            ->where('stock', '<', 5)
            ->count();
        
        $recentTransactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        // Sales chart data (last 7 days)
        $salesChart = Transaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'todayTransactions',
            'todayRevenue',
            'lowStockProducts',
            'recentTransactions',
            'salesChart'
        ));
    }
}