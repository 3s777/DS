<?php

namespace Domain\Settings\Models;

use Database\Factories\Settings\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasSlug;

class Country extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug'
    ];

    public $translatable = ['name'];

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
