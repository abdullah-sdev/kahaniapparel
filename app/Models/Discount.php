<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'start_date',
        'end_date',
        'usage_limit',
        'usage_count',
        'status',
        'type',
        'value',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isExpired(): bool
    {
        return $this->end_date < now();
    }

    public function isValid(): bool
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isUsed(): bool
    {
        return $this->usage_count >= $this->usage_limit;
    }
}
