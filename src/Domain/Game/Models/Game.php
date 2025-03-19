<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GameFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\GameFilterRegistrar;
use Domain\Game\QueryBuilders\GameQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Casts\ArrayWithoutUnicode;
use Support\Traits\Models\HasImages;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasUser;

class Game extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use HasImages;
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
        'released_at' => 'date',
        'description' => CleanHtml::class.':custom',
        'alternative_names' => ArrayWithoutUnicode::class,
        'images' => 'array',
    ];

    public $translatable = ['description'];

    //    protected function asJson($value)
    //    {
    //        return json_encode($value, JSON_UNESCAPED_UNICODE);
    //    }

    //    protected function alternativeNames(): Attribute
    //    {
    //        return Attribute::make(
    //            set: fn (?string $value) => json_encode(explode('||', $value)),
    //        );
    //    }

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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile();

        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }

    public function imagesDir(): string
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

    public function developers(): MorphToMany
    {
        return $this->morphToMany(GameDeveloper::class, 'game_developerable');
    }

    public function publishers(): MorphToMany
    {
        return $this->morphToMany(GamePublisher::class, 'game_publisherable');
    }

    public function genres(): MorphToMany
    {
        return $this->morphToMany(GameGenre::class, 'game_genrable');
    }

    public function platforms(): MorphToMany
    {
        return $this->morphToMany(GamePlatform::class, 'game_platformable');
    }

}
