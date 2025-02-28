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
        'price',
        'description',
        'thumbnail_image',
        'thumbnail_image1',
        'clicks',
        'is_in_stock',
        'is_enable',
    ];

    public function categories(): belongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function sizes(): belongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
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
