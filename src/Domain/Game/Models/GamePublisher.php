<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GamePublisherFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\GamePublisherFilterRegistrar;
use Domain\Game\QueryBuilders\GamePublisherQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasUser;

class GamePublisher extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use HasUser;
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    public $translatable = ['description'];

    protected static function newFactory(): GamePublisherFactory
    {
        return GamePublisherFactory::new();
    }

    public function imagesDir(): string
    {
        return 'game_publisher';
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
        return app(GamePublisherFilterRegistrar::class)->filtersList();
    }

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    public function newEloquentBuilder($query): GamePublisherQueryBuilder
    {
        return new GamePublisherQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
