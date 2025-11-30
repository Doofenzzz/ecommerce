<?php
// routes/web.php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Cashier\TransactionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirect based on role after login
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('cashier.transaction');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Products - low-stock HARUS sebelum resource!
        Route::get('/products/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');
        Route::resource('products', ProductController::class);
        
        // Users
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::resource('users', UserController::class)->except(['show']);
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/{transaction}', [ReportController::class, 'show'])->name('reports.show');
    });

    // Cashier Routes
    Route::middleware(['role:cashier,admin'])->prefix('cashier')->name('cashier.')->group(function () {
        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
        Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
        Route::get('/products/search', [TransactionController::class, 'searchProducts'])->name('products.search');
        
        // History
        Route::get('/history', [ReportController::class, 'index'])->name('history');
        Route::get('/history/{transaction}', [ReportController::class, 'show'])->name('history.show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';