<?php

namespace Domain\Game\Models;

use App\Filters\DatesFilter;
use App\Filters\SearchFilter;
use App\Models\Media;
use Domain\Game\QueryBuilders\GameDeveloperQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\Image\Enums\BorderType;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\Conversions\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

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

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public array $sortedFields = [
        'id',
        'name',
        'created_at'
    ];

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
            DatesFilter::make('Датируем', 'dates'),
            SearchFilter::make('Ищем', 'search'),
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function newEloquentBuilder($query): GameDeveloperQueryBuilder
    {
        return new GameDeveloperQueryBuilder($query);
    }
}
