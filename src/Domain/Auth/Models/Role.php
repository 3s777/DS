<?php

namespace Domain\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Translatable\HasTranslations;
use Support\Traits\Models\HasCustomAudit;
use OwenIt\Auditing\Auditable as HasAuditable;
use OwenIt\Auditing\Contracts\Auditable;

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
