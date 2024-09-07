<?php

namespace Domain\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettingValue extends Model
{
    use HasFactory;

    public function setting(): BelongsTo
    {
        return $this->belongsTo(UserSetting::class);
    }
}
