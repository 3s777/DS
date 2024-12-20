<?php

namespace Domain\Shelf\Models;

use Database\Factories\Shelf\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;
use Support\Traits\Models\HasSlug;

class Category extends Model implements Auditable
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use HasAuditable;
    use HasCustomAudit;

    protected $fillable = [
        'name',
        'model',
        'slug',
        'description',
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public $translatable = [
        'name',
        'description'
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
