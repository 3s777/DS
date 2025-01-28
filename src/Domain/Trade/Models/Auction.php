<?php

namespace Domain\Trade\Models;

use Database\Factories\Trade\AuctionFactory;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Support\Casts\Price;

class Auction extends Model
{
    /** @use HasFactory<\Database\Factories\Trade\AuctionFactory> */
    use HasFactory;

    protected $fillable = [
        'collectible_id',
        'price',
        'step',
        'finished_at'
    ];

    protected $casts = [
        'price' => Price::class,
        'step' => Price::class
    ];

    protected static function newFactory(): AuctionFactory
    {
        return AuctionFactory::new();
    }

    public function collectible(): BelongsTo
    {
        return $this->belongsTo(Collectible::class);
    }
}
