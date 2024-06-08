<?php

namespace Domain\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Casts\CleanHtml;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Translatable\HasTranslations;

class Permission extends SpatiePermission
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    public $translatable = ['display_name'];
}
