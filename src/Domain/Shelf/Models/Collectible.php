<?php

namespace Domain\Shelf\Models;

use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\User;
use Domain\Shelf\Casts\Auction;
use Domain\Shelf\Casts\Properties;
use Domain\Shelf\Casts\Sale;
use Domain\Shelf\FilterRegistrars\CollectibleFilterRegistrar;
use Domain\Shelf\QueryBuilders\CollectibleQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'kit_conditions',
        'condition',
        'description',
        'user_id',
        'featured_image',
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
        'kit_conditions' => 'array',
        'images' => 'array',
        'properties' => Properties::class,
        'sale' => Sale::class,
        'auction' => Auction::class,
        'purchase_price' => Price::class
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $item) {
            $item->category_id = Category::where('model', $item->collectable_type)->first()->id;
        });
    }

    protected static function newFactory(): CollectibleFactory
    {
        return CollectibleFactory::new();
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

    public function availableFilters(): array
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

    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class);
    }

    public function collectable(): MorphTo
    {
        return $this->morphTo();
    }

//    public function kitItems(): BelongsToMany
//    {
//        return $this->belongsToMany(KitItem::class);
//    }

    public function kitItems(): MorphToMany
    {
        return $this->morphToMany(KitItem::class, 'kitable')->withPivot('condition');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
