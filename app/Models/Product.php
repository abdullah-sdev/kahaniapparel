<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function categories(): HasMany
    {
        return $this->HasMany(ProductCategory::class);
    }

    public function sizes(): HasMany
    {
        return $this->HasMany(ProductSize::class);
    }

    public function colors(): HasMany
    {
        return $this->HasMany(ProductColor::class);
    }

}
