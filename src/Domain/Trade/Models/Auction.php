<?php

namespace Domain\Trade\Models;

use Database\Factories\Trade\AuctionFactory;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Observers\AuctionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Support\Casts\Price;

#[ObservedBy([AuctionObserver::class])]
class Auction extends Model
{
    /** @use HasFactory<\Database\Factories\Trade\AuctionFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'collectible_id',
        'price',
        'step',
        'finished_at',
        'blitz',
        'renewal',
        'country_id',
        'shipping',
        'self_delivery'
    ];

    protected $casts = [
        'price' => Price::class,
        'step' => Price::class,
        'blitz' => Price::class,
        'finished_at' => 'datetime'
    ];

    protected static function newFactory(): AuctionFactory
    {
        return AuctionFactory::new();
    }

    public function collectible(): BelongsTo
    {
        return $this->belongsTo(Collectible::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function shippingCountries(): MorphToMany
    {
        return $this->morphToMany(Country::class, 'countriesable');
    }
}
