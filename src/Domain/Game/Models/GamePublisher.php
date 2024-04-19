<?php

namespace Domain\Game\Models;

use Domain\Game\QueryBuilders\GameDeveloperQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Support\Traits\Models\HasSlug;

class GamePublisher extends Model
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function newEloquentBuilder($query): GameDeveloperQueryBuilder
    {
        return new GameDeveloperQueryBuilder($query);
    }

}
