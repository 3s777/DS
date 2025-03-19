<?php

namespace Domain\Shelf\Models;

use Database\Factories\Shelf\KitItemFactory;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasUser;

class KitItem extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use HasAuditable;
    use HasCustomAudit;
    use HasSlug;
    use HasUser;

    protected $fillable = [
        'name',
        'slug',
        'user_id'
    ];

    public $translatable = ['name'];

    protected static function newFactory(): KitItemFactory
    {
        return KitItemFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
