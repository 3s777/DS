<?php

namespace Domain\Shelf\Models;

use App\Casts\ArrayWithoutUnicode;
use App\Casts\Price;
use Database\Factories\Game\GameFactory;
use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\GameFilterRegistrar;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GameGenre;
use Domain\Game\Models\GamePlatform;
use Domain\Game\Models\GamePublisher;
use Domain\Game\QueryBuilders\GameQueryBuilder;
use Domain\Shelf\FilterRegistrars\CollectibleFilterRegistrar;
use Domain\Shelf\QueryBuilders\CollectibleQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasUser;


class Collectible extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasThumbnail;
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
        'sale',
        'auction',
        'kit_conditions',
        'condition',
        'description',
        'user_id',
        'thumbnail',
//        'collectable_id',
//        'collectable_type'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
        'kit_conditions' => 'json',
        'properties' => 'json',
        'sale' => 'json',
        'auction' => 'json',
        'purchase_price' => Price::class
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    protected static function newFactory(): CollectibleFactory
    {
        return CollectibleFactory::new();
    }

    public function thumbnailDir(): string
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

    public function kitItems(): BelongsToMany
    {
        return $this->belongsToMany(KitItem::class);
    }
}
