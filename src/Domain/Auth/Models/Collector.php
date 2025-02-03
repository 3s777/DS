<?php

namespace Domain\Auth\Models;

use App\Filters\DatesFilter;
use App\Filters\SearchFilter;
use App\Models\Image;
use Database\Factories\CollectorFactory;
use Database\Factories\UserFactory;
use Domain\Auth\Notifications\ResetPasswordNotification;
use Domain\Auth\Notifications\VerifyEmailNotification;
use Domain\Auth\QueryBuilders\CollectorQueryBuilder;
use Domain\Auth\QueryBuilders\UserQueryBuilder;
use Domain\Game\Models\Game;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Mews\Purifier\Casts\CleanHtml;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Support\Traits\Models\HasCustomAudit;
use Support\Traits\Models\HasFeaturedImage;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;

class Collector extends Authenticatable implements MustVerifyEmail, HasLocalePreference, HasMedia, Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasSlug;
    use Notifiable;
    use SoftDeletes;
    use HasImage;
    use HasFeaturedImage;
    use InteractsWithMedia;
    use HasRoles;
    use HasPermissions;
    use HasAuditable;
    use HasCustomAudit;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'slug',
        'password',
        'language',
        'first_name',
        'featured_image',
        'description',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'description' => CleanHtml::class.':custom',
    ];

    public array $sortedFields = [
        'id',
        'name',
        'created_at',
        'email',
        'first_name'
    ];

    protected static function newFactory(): CollectorFactory
    {
        return CollectorFactory::new();
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function newEloquentBuilder($query): CollectorQueryBuilder
    {
        return new CollectorQueryBuilder($query);
    }

    public function imagesDir(): string
    {
        return 'collector';
    }

    public function thumbnailSizes(): array
    {
        return [
            'small' => ['220', '220'],
            'medium' => ['500', '500'],
            'full_preview' => ['550', '550'],
            'extra_small' => ['100', '100'],
            'extra_small1' => ['50', '50']
        ];
    }

    public function availableFilters(): array
    {
        return [
            'dates' => DatesFilter::make(
                __('common.dates'),
                'dates',
                'users'
            ),
            'search' => SearchFilter::make(
                __('common.search'),
                'search',
                'users'
            ),
        ];
    }


    public function preferredLocale()
    {
        return $this->language;
    }

    public function img(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function morphImages(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
