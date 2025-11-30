<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_number', 'user_id', 'total', 'paid', 'change'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
        'change' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public static function generateTransactionNumber()
    {
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', now())->latest()->first();
        $number = $lastTransaction ? (int) substr($lastTransaction->transaction_number, -4) + 1 : 1;
        return 'TRX-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
