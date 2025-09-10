<?php

namespace Domain\Shelf\Models;

use Admin\Shelf\FilterRegistrars\ShelfFilterRegistrar;
use Database\Factories\Shelf\ShelfFactory;
use Domain\Auth\Models\Collector;
use Domain\Shelf\QueryBuilders\ShelfQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCollector;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasImage;

class Shelf extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use HasTranslations;
    use HasCollector;

    protected $fillable = [
        'name',
        'number',
        'ulid',
        'description',
        'collector_id',
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'number',
        'created_at'
    ];

    protected static function newFactory(): ShelfFactory
    {
        return ShelfFactory::new();
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
        return app(ShelfFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): ShelfQueryBuilder
    {
        return new ShelfQueryBuilder($query);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(Collector::class);
    }

    public function collectibles(): HasMany
    {
        return $this->hasMany(Collectible::class);
    }
    //
    //    public function platforms(): MorphToMany
    //    {
    //        return $this->morphToMany(GamePlatform::class, 'game_platformable');
    //    }
}
