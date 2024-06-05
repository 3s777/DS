<?php

namespace Domain\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Filters\DatesFilter;
use App\Filters\RelationFilter;
use App\Filters\SearchFilter;
use App\Models\Image;
use App\Models\Language;
use Database\Factories\UserFactory;
use Domain\Auth\Notifications\ResetPasswordNotification;
use Domain\Auth\Notifications\VerifyEmailNotification;
use Domain\Auth\QueryBuilders\UserQueryBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference, HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasSlug;
    use Notifiable;
    use SoftDeletes;
    use HasThumbnail;
    use InteractsWithMedia;
    use HasRoles;

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
        'language_id',
        'first_name',
        'thumbnail',
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
        $this->notify(new VerifyEmailNotification());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    public function thumbnailDir(): string
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

    public function updatePassword($password): void
    {
        if(!$password) {
            $this->deleteAllThumbnails();
        }
    }

    public function settingsValue(): BelongsToMany
    {
        return $this->belongsToMany(UserSettingValue::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function preferredLocale()
    {
        return $this->language->slug;
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
