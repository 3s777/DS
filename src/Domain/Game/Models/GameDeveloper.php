<?php

namespace Domain\Game\Models;

use App\Models\CollectableItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Support\Traits\Models\HasSlug;

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
        'description' => CleanHtml::class.':custom'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
