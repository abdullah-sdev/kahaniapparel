<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'actual_price',
        'discounted_price',
        'description',
        'thumbnail_image',
        'thumbnail_image1',
        'clicks',
        'is_in_stock',
        'is_enable',
    ];

    protected $casts = [
        'is_in_stock' => 'boolean',
        'is_enable' => 'boolean',
    ];

    protected $attributes = [
        'clicks' => 0,
        'is_in_stock' => true,
        'is_enable' => true,
    ];

    public function categories(): belongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function sizes(): belongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'imageable')->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
