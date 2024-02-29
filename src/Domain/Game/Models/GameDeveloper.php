<?php

namespace Domain\Game\Models;

use App\Filters\DatesFilter;
use App\Filters\SearchFilter;
use App\Models\CollectableItem;
use Carbon\Carbon;
use Domain\Game\QueryBuilders\GameDeveloperQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pipeline\Pipeline;
use Mews\Purifier\Casts\CleanHtml;
use Support\Traits\Models\HasSlug;

/**
 * @method  static GameDeveloper|GameDeveloperQueryBuilder query()
 */
class GameDeveloper extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description'
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
            SearchFilter::make('Ищем'),
            new DatesFilter('Датируем')
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
