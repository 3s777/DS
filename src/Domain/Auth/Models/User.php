<?php

namespace Domain\Auth\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Image;
use App\Models\Language;
use Database\Factories\UserFactory;
use Domain\Auth\Notifications\ResetPasswordNotification;
use Domain\Auth\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Support\Traits\Models\HasThumbnail;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference, HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasThumbnail;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'language_id',
        'avatar_id'
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

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    protected function thumbnailDir(): string
    {
        return 'avatars';
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . $this->name
        );
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

    //    public function thumbnail(): HasOne
    //    {
    //        return $this->hasOne(Image::class)->where('id', $this->avatar_id);
    //    }
    //
    //    public function cover(): HasOne
    //    {
    //        return $this->hasOne(Image::class)->where('id', $this->cover_id);
    //    }

    public function img(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function morphImages()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    //    public function registerMediaCollections(): void
    //    {
    ////        $this->addMediaCollection('my-collection')
    ////        //add options
    ////        ...
    ////
    ////    // you can define as many collections as needed
    ////    $this->addMediaCollection('my-other-collection')
    //        //add options
    //        ...
    //}


    //    public function images()
    //    {
    //        return $this->hasMany(Image::class);
    //    }
    public function thumbnailSizes(): array
    {
        return [];
    }
}
