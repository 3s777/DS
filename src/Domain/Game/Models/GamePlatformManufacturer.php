<?php

namespace Domain\Game\Models;

use Database\Factories\Game\GamePlatformManufacturerFactory;
use Database\Factories\Game\GamePublisherFactory;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasThumbnail;
use Support\Traits\Models\HasUser;

class GamePlatformManufacturer extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasImage;
    use HasThumbnail;
    use HasUser;
    use HasTranslations;

    protected $table = 'game_platform_manufacturers';

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

    protected static function newFactory(): GamePlatformManufacturerFactory
    {
        return GamePlatformManufacturerFactory::new();
    }

    public function imagesDir(): string
    {
        return 'game_platform_manufacturer';
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
