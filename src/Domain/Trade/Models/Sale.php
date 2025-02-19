<?php

namespace Domain\Trade\Models;

use Database\Factories\Trade\SaleFactory;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Support\Casts\Price;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\Trade\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'collectible_id',
        'price',
        'price_old',
        'bidding',
        'quantity',
        'country_id',
        'shipping'
    ];

    protected $casts = [
        'price' => Price::class,
        'price_old' => Price::class
    ];

    protected static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }

    public function collectible(): BelongsTo
    {
        return $this->belongsTo(Collectible::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function shipping_countries(): MorphToMany
    {
        return $this->morphToMany(Country::class, 'countriesable');
    }
}
