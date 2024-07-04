<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GameGenreFactory;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasUser;

class GameGenre extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use HasUser;
    use HasTranslations;

    protected $table = 'game_genres';

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

    protected static function newFactory(): GameGenreFactory
    {
        return GameGenreFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
