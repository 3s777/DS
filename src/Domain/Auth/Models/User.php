<?php

namespace Domain\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Image;
use Database\Factories\UserFactory;
use Domain\Auth\FilterRegitrars\AdminFilterRegistrar;
use Domain\Auth\Notifications\ResetPasswordAdminNotification;
use Domain\Auth\Notifications\VerifyEmailAdminNotification;
use Domain\Auth\QueryBuilders\UserQueryBuilder;
use Domain\Game\Models\Game;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mews\Purifier\Casts\CleanHtml;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Support\Traits\Models\HasCustomAudit;
use Support\Traits\Models\HasImage;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasFeaturedImage;
use OwenIt\Auditing\Auditable as HasAuditable;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference, HasMedia, Auditable
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

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailAdminNotification());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordAdminNotification($token));
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    public function imagesDir(): string
    {
        return 'user';
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
        return app(AdminFilterRegistrar::class)->filtersList();
    }

//    public function updatePassword($password): void
//    {
//        if(!$password) {
//            $this->deleteAllThumbnails();
//        }
//    }

    public function settingsValue(): BelongsToMany
    {
        return $this->belongsToMany(UserSettingValue::class);
    }

    public function preferredLocale()
    {
        return $this->language;
    }

//    public function img(): HasOne
//    {
//        return $this->hasOne(Image::class);
//    }

    public function morphImages(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
