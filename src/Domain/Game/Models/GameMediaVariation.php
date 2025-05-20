<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GameMediaVariationFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\Admin\GameMediaVariationFilterRegistrar;
use Domain\Game\FilterRegistrars\Public\GameMediaVariationFilterRegistrar as VariationFilterRegistrar;
use Domain\Game\Observers\GameMediaVariationObserver;
use Domain\Game\QueryBuilders\GameMediaVariationQueryBuilder;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Casts\ArrayWithoutUnicode;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasImages;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasUser;

#[ObservedBy([GameMediaVariationObserver::class])]
class GameMediaVariation extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use HasImages;
    use HasUser;
    use HasTranslations;

    protected $table = 'game_media_variations';

    protected $fillable = [
        'name',
        'slug',
        'article_number',
        'barcodes',
        'alternative_names',
        'description',
        'user_id',
        'game_media_id',
        'is_main'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
        'alternative_names' => ArrayWithoutUnicode::class,
        'barcodes' => ArrayWithoutUnicode::class,
        'images' => 'array',
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'article_number',
        'game_medias.name',
        'created_at',
        'is_main',
        'users.name'
    ];

    protected static function newFactory(): GameMediaVariationFactory
    {
        return GameMediaVariationFactory::new();
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
        return 'game_media_variation';
    }

    public function thumbnailSizes(): array
    {
        return [
            'extra_small' => ['100', '100'],
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
        return app(GameMediaVariationFilterRegistrar::class)->filtersList();
    }

    public function availableFilters(): array
    {
        return app(VariationFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): GameMediaVariationQueryBuilder
    {
        return new GameMediaVariationQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gameMedia(): BelongsTo
    {
        return $this->belongsTo(GameMedia::class);
    }

    public function kitItems(): MorphToMany
    {
        return $this->morphToMany(KitItem::class, 'kitable');
    }

    public function collectibles(): MorphMany
    {
        return $this->morphMany(Collectible::class, 'collectable');
    }
}
