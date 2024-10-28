<?php

namespace Domain\Shelf\Models;

use Database\Factories\Shelf\CollectibleFactory;
use Database\Factories\Shelf\ShelfFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;
use Domain\Shelf\FilterRegistrars\ShelfFilterRegistrar;
use Domain\Shelf\QueryBuilders\ShelfQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasUser;

class Shelf extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasThumbnail;
    use HasUser;
    use HasTranslations;


    protected $fillable = [
        'name',
        'number',
        'ulid',
        'description',
        'user_id',
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'number',
        'created_at',
        'users.email'
    ];

    protected static function newFactory(): ShelfFactory
    {
        return ShelfFactory::new();
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
        return app(ShelfFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): ShelfQueryBuilder
    {
        return new ShelfQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
