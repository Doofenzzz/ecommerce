<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil data yang diperlukan saja untuk memperingan load
        $products = Product::select('id', 'code', 'name', 'selling_price', 'stock')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->get();

        return view('cashier.transaction', compact('products'));
    }

    public function searchProducts(Request $request)
    {
        $search = $request->get('q');
        
        $products = Product::select('id', 'code', 'name', 'selling_price', 'stock')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'paid' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $totalServer = 0;
            $itemsToInsert = [];

            // 2. Loop Validasi Stok & Hitung Ulang Total (SERVER SIDE CALCULATION)
            foreach ($request->items as $itemData) {
                // PENTING: Gunakan lockForUpdate() untuk mencegah race condition (stok minus saat transaksi bersamaan)
                $product = Product::where('id', $itemData['product_id'])
                            ->lockForUpdate() 
                            ->first();

                if (!$product) {
                    throw new \Exception("Produk dengan ID {$itemData['product_id']} tidak ditemukan.");
                }

                // Cek Stok Realtime
                if ($product->stock < $itemData['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi (Sisa: {$product->stock}).");
                }

                // Hitung subtotal menggunakan HARGA DARI DATABASE, bukan dari request (Security)
                $subtotal = $product->selling_price * $itemData['quantity'];
                $totalServer += $subtotal;

                // Siapkan data untuk disimpan nanti
                $itemsToInsert[] = [
                    'product' => $product,
                    'quantity' => $itemData['quantity'],
                    'price' => $product->selling_price, // Ambil harga asli DB
                    'subtotal' => $subtotal
                ];
            }

            // 3. Cek Uang Pembayaran
            if ($request->paid < $totalServer) {
                throw new \Exception("Uang pembayaran kurang! Total: Rp " . number_format($totalServer, 0, ',', '.'));
            }

            $change = $request->paid - $totalServer;

            // 4. Buat Header Transaksi
            $transaction = Transaction::create([
                'transaction_number' => Transaction::generateTransactionNumber(),
                'user_id' => auth()->id(),
                'total' => $totalServer, // Total hasil hitungan server
                'paid' => $request->paid,
                'change' => $change,
            ]);

            // 5. Simpan Detail & Kurangi Stok
            foreach ($itemsToInsert as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Kurangi stok
                $item['product']->decrement('stock', $item['quantity']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'transaction' => $transaction,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // Return error 400 (Bad Request) atau 422 (Unprocessable)
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}