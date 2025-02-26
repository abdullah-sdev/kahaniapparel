<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'product_attributes',
    ];

    public function order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }
}
