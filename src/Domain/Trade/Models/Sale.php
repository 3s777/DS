<?php

namespace Domain\Trade\Models;

use Database\Factories\Trade\SaleFactory;
use Domain\Settings\Models\Country;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
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
        'shipping',
        'self_delivery',
        'reservation'
    ];

    protected $casts = [
        'price' => Price::class,
        'price_old' => Price::class
    ];

//    protected static function boot()
//    {
//        parent::boot();
//
//        static::created(function(Model $item) {
//            $collectible = Collectible::find($item->collectible_id);
//
//            $sale = [
//                'price' => $collectible->sale->price->value(),
//                'price_old' => $collectible->sale->price_old->value(),
//                'bidding' => $collectible->sale->bidding,
//                'country_id' => $collectible->sale->country->id,
//                'shipping' => ShippingEnum::tryFrom($collectible->sale->shipping)->value,
//                'quantity' => $collectible->sale->quantity,
//                'reservation' => ReservationEnum::tryFrom($collectible->sale->reservation)->value,
//                'self_delivery' => $collectible->sale->self_delivery
//            ];
//
//            $collectible->sale_data = $sale;
//
//            $collectible->save();
//        });
//    }

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

    public function shippingCountries(): MorphToMany
    {
        return $this->morphToMany(Country::class, 'countriesable');
    }
}
