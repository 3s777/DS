<?php

namespace Domain\Trade\Models;

use Database\Factories\Trade\SaleFactory;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\Trade\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'price',
        'old_price',
        'quantity'
    ];

    protected static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }

    public function collectible(): BelongsTo
    {
        return $this->belongsTo(Collectible::class);
    }
}
