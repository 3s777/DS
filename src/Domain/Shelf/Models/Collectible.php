<?php

namespace Domain\Shelf\Models;

use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Domain\Shelf\Casts\Properties;
use Domain\Shelf\FilterRegistrars\CollectibleFilterRegistrar;
use Domain\Shelf\Observers\CollectibleObserver;
use Domain\Shelf\QueryBuilders\CollectibleQueryBuilder;
use Domain\Trade\Models\Auction;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Casts\Price;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasImages;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasUser;
use Domain\Shelf\Casts\Auction as AuctionCast;
use Domain\Shelf\Casts\Sale as SaleCast;

#[ObservedBy([CollectibleObserver::class])]
class Collectible extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use HasImages;
    use HasUser;
    use HasTranslations;

    protected $fillable = [
        'name',
        'ulid',
        'shelf_id',
        'article_number',
        'purchase_price',
        'purchased_at',
        'seller',
        'additional_field',
        'properties',
        'target',
        'kit_score',
        'kit_conditions',
        'condition',
        'description',
        'user_id',
        'collector_id',
        'featured_image',
        'sale_data',
        'auction_data'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
        'kit_conditions' => 'array',
        'images' => 'array',
        'properties' => Properties::class,
        'sale_data' => SaleCast::class,
        'auction_data' => AuctionCast::class,
        'purchase_price' => Price::class
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'purchase_price',
        'purchased_at',
        'kit_score',
        'condition',
        'seller',
        'sale_data',
        'auction_data',
        'collectors.name',
        'category_id',
//        'users.email',
        'article_number',
        'additional_field'
    ];

    protected static function newFactory(): CollectibleFactory
    {
        return CollectibleFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }


    public function imagesDir(): string
    {
        return 'shelf';
    }

    public function thumbnailSizes(): array
    {
        return [
            'small' => ['220', '220'],
            'medium' => ['500', '500'],
            'full_preview' => ['550', '550'],
            'full_preview_300' => ['300', '300'],
            'full_preview_400' => ['400', '400'],
            'full_preview_600' => ['600', '600'],
            'full_preview_1200' => ['1200', '1200'],
            'large' => ['1000', '1000'],
        ];
    }

    public function availableAdminFilters(): array
    {
        return app(CollectibleFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): CollectibleQueryBuilder
    {
        return new CollectibleQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }

    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    public function collectable(): MorphTo
    {
        return $this->morphTo();
    }

    public function kitItems(): BelongsToMany
    {
        return $this->belongsToMany(KitItem::class)->withPivot('condition');
    }

    //    public function kitItems(): MorphToMany
    //    {
    //        return $this->morphToMany(KitItem::class, 'kitable')->withPivot('condition');
    //    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }

    public function auction(): HasOne
    {
        return $this->hasOne(Auction::class);
    }
}
