<?php

namespace Domain\Auth\Models;

use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\FilterRegistrars\CollectorFilterRegistrar;
use Domain\Auth\Notifications\ResetPasswordCollectorNotification;
use Domain\Auth\Notifications\VerifyEmailCollectorNotification;
use Domain\Auth\QueryBuilders\CollectorQueryBuilder;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Admin\Auth\FilterRegistrars\CollectorFilterRegistrar as AdminCollectorFilterRegistrar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
use Support\Models\Image;
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

    protected $guard_name = 'collector';

    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn () => '@'.$this->name
        );
    }

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
        $this->notify(new VerifyEmailCollectorNotification());
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordCollectorNotification($token));
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

    public function availableAdminFilters(): array
    {
        return app(AdminCollectorFilterRegistrar::class)->filtersList();
    }

    public function availableFilters(): array
    {
        return app(CollectorFilterRegistrar::class)->filtersList();
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

    public function shelves(): HasMany
    {
        return $this->hasMany(Shelf::class);
    }

    public function collectibles(): HasMany
    {
        return $this->hasMany(Collectible::class);
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(
            Collector::class,
            'collector_subscriptions',
            'subscriber_id',
            'collector_id'
        );
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(
            Collector::class,
            'collector_subscriptions',
            'collector_id',
            'subscriber_id',
        );
    }
}
