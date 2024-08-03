<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GameFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\GameFilterRegistrar;
use Domain\Game\QueryBuilders\GameQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasUser;

class Game extends Model implements HasMedia
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
        'alternative_names',
        'description',
        'user_id',
        'released_at'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
        'alternative_names' => 'array'
    ];


    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.email'
    ];

    protected static function newFactory(): GameFactory
    {
        return GameFactory::new();
    }

    public function thumbnailDir(): string
    {
        return 'game';
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
        return app(GameFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): GameQueryBuilder
    {
        return new GameQueryBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(GameDeveloper::class);
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(GamePublisher::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(GameGenre::class);
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(GamePlatform::class);
    }

}
