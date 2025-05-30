<?php

namespace Domain\Game\Models;

use App\Contracts\HasProperties;
use Database\Factories\Game\GameMediaFactory;
use Domain\Auth\Models\User;
use Domain\Game\FilterRegistrars\Admin\GameMediaFilterRegistrar as AdminGameMediaFilterRegistrar;
use Domain\Game\FilterRegistrars\Public\GameMediaFilterRegistrar;
use Domain\Game\Models\Traits\GameProperties;
use Domain\Game\QueryBuilders\GameMediaQueryBuilder;
use Domain\Shelf\Contracts\Mediable;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\KitItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Casts\ArrayWithoutUnicode;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasImages;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasUser;

class GameMedia extends Model implements HasMedia, Mediable
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

    protected $table = 'game_medias';

    protected $fillable = [
        'name',
        'slug',
        'article_number',
        'barcodes',
        'alternative_names',
        'description',
        'user_id',
        'released_at'
    ];

    protected $casts = [
        'released_at' => 'date',
        'description' => CleanHtml::class.':custom',
        'alternative_names' => ArrayWithoutUnicode::class,
        'barcodes' => ArrayWithoutUnicode::class,
        'images' => 'array',
    ];

    public $translatable = ['description'];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'users.name'
    ];

    protected static function newFactory(): GameMediaFactory
    {
        return GameMediaFactory::new();
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
        return 'game_media';
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

    public function availableAdminFilters(): array
    {
        return app(AdminGameMediaFilterRegistrar::class)->filtersList();
    }

    public function availableFilters(): array
    {
        return app(GameMediaFilterRegistrar::class)->filtersList();
    }

    public function newEloquentBuilder($query): GameMediaQueryBuilder
    {
        return new GameMediaQueryBuilder($query);
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

    public function games(): MorphToMany
    {
        return $this->morphToMany(Game::class, 'gameable');
    }

    public function kitItems(): MorphToMany
    {
        return $this->morphToMany(KitItem::class, 'kitable');
    }

    public function collectibles(): MorphMany
    {
        return $this->morphMany(Collectible::class, 'collectable');
    }

    public function variations(): HasMany
    {
        return $this->hasMany(GameMediaVariation::class);
    }

    public function mainVariation(): HasOne
    {
        return $this->variations()->one()->where('is_main', true);
    }
}
