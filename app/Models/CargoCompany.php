<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CargoCompany extends Model
{
    /** @use HasFactory<\Database\Factories\CargoCompanyFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'tax_number',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
