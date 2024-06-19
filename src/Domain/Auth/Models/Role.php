<?php

namespace Domain\Auth\Models;

use Domain\Auth\Observers\RoleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;

#[ObservedBy([RoleObserver::class])]
class Role extends SpatieRole implements Auditable
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
}
