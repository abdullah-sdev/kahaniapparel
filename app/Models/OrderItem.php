<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Order::class, 'order_id', 'user_id', 'id');
    }
}
