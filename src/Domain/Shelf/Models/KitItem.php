<?php


namespace Domain\Shelf\Models;

use Database\Factories\Shelf\KitItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;
use Support\Traits\Models\HasSlug;

class KitItem extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use HasAuditable;
    use HasCustomAudit;
    use HasSlug;

    protected $fillable = [
        'name',
        'slug'
    ];

    public $translatable = ['name'];

    protected static function newFactory(): KitItemFactory
    {
        return KitItemFactory::new();
    }
}
