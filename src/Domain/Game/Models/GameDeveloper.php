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

/**
 * @method  static GameDeveloper|GameDeveloperQueryBuilder query()
 */
class GameDeveloper extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;

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

    public function registerMediaConversions(Media|\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format(Manipulations::FORMAT_WEBP)
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('xcvcxv')
            ->width(500)
            ->height(300)
            ->sharpen(10);

    }
}
