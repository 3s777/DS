<?php
namespace Domain\Page\Models;

use Database\Factories\Page\PageFactory;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasUser;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use InteractsWithMedia;
    use HasImage;
    use HasFeaturedImage;
    use SoftDeletes;
    use HasUser;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id'
    ];

    public $translatable = ['name', 'description'];

    public function imagesDir(): string
    {
        return 'page';
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

    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PageCategory::class);
    }
}
