<?php

namespace Domain\Auth\Models;

use Database\Factories\PermissionFactory;
use Domain\Auth\Observers\PermissionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;

#[ObservedBy([PermissionObserver::class])]
class Permission extends SpatiePermission implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;
    use HasAuditable;
    use HasCustomAudit;

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public $translatable = ['display_name'];

    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }
}
