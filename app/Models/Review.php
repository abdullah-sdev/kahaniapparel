<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'product_id',
        'user_id',
        'order_item_id',
        'comment',
        'rating',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): \Znck\Eloquent\Relations\BelongsToThrough
    {
        return $this->belongsToThrough(Order::class, OrderItem::class);
    }

    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'imageable')->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
