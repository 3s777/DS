<?php

namespace Domain\Game\Models;

use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use Database\Factories\Game\GameDeveloperFactory;
use Domain\Auth\Models\User;
use Domain\Game\QueryBuilders\GameDeveloperQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasUser;

/**
 * @method  static GameDeveloper|GameDeveloperQueryBuilder query()
 */
class GameDeveloper extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasThumbnail;
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

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    protected static function newFactory(): GameDeveloperFactory
    {
        return GameDeveloperFactory::new();
    }

    public function thumbnailDir(): string
    {
        return 'game_developer';
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
            'extra_small' => ['100', '100'],
            'extra_small1' => ['50', '50']
        ];
    }

    public function availableFilters(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'game_developers'
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'game_developers'
            ),
            'user' => RelationFilter::make(
                __('common.user'),
                'user',
                'game_developers',
                'user_id',
                User::class
            ),
        ];
    }

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    public function newEloquentBuilder($query): GameDeveloperQueryBuilder
    {
        return new GameDeveloperQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
