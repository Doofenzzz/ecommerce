<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user')->latest();

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by cashier (admin only)
        if (auth()->user()->isAdmin() && $request->filled('cashier_id')) {
            $query->where('user_id', $request->cashier_id);
        }

        // If cashier, only show their transactions
        if (auth()->user()->isCashier()) {
            $query->where('user_id', auth()->id());
        }

        $transactions = $query->paginate(20);
        
        $totalRevenue = $query->sum('total');
        
        $cashiers = auth()->user()->isAdmin() 
            ? User::where('role', 'cashier')->get() 
            : collect();

        return view('reports.index', compact('transactions', 'totalRevenue', 'cashiers'));
    }

    public function show(Transaction $transaction)
    {
        // Check if cashier is viewing their own transaction
        if (auth()->user()->isCashier() && $transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->load(['details.product', 'user']);

        return view('reports.show', compact('transaction'));
    }
}