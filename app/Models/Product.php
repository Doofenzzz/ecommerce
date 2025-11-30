<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'category', 'purchase_price', 
        'selling_price', 'stock', 'unit', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}