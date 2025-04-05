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
        'address_id',
        'payment_status',
        'tracking_number',
        'order_status',
        'payment_type',
        'cargo_company_id',
        'discount_id',
        'subtotal',
        'delivery_cost',
    ];

    public function cargoCompany(): BelongsTo
    {
        return $this->belongsTo(CargoCompany::class, 'cargo_company_id');
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
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

    // Scopes
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeProcessing($query)
    {
        return $query->where('order_status', 'processing');
    }

    public function scopeShipped($query)
    {
        return $query->where('order_status', 'shipped');
    }

    // Helpers
    public function total()
    {
        return $this->subtotal + $this->delivery_cost;
    }

    public function markAsPaid()
    {
        $this->update(['payment_status' => 'paid']);
    }

    public function markAsShipped($trackingNumber)
    {
        $this->update([
            'order_status' => 'shipped',
            'tracking_number' => $trackingNumber,
        ]);
    }
}
