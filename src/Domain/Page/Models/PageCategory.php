<?php

namespace Domain\Page\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Support\Traits\Models\HasSlug;
use Spatie\Translatable\HasTranslations;
use Mews\Purifier\Casts\CleanHtml;
use Database\Factories\Page\PageCategoryFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Domain\Auth\Models\User;
use Support\Traits\Models\HasUser;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;
    use HasUser;
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'user_id',
        'parent_id'
    ];

    protected $casts = [
        'description' => CleanHtml::class.':custom',
    ];

    protected static function newFactory(): PageCategoryFactory
    {
        return PageCategoryFactory::new();
    }

    public $translatable = ['name', 'description'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(PageCategory::class, 'parent_id');
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class);
    }
}
