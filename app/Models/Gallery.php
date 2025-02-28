<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Gallery extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryFactory> */
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'image_path',
        'sort_order',
        'description',
    ];

     // Define the polymorphic relationship
     public function imageable() : MorphTo
     {
         return $this->morphTo();
     }
}
