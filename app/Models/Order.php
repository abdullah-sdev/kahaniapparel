<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_status',
        'tracking_number',
        'order_status',
        'payment_type',
        'cargo_company_id',
        'discount_id',
        'subtotal',
        'delivery_cost',
    ];

    public function cargo_company(): HasOne
    {
        return $this->hasOne(CargoCompany::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, OrderItem::class);
    }
}
