<?php

namespace Domain\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformType extends Model
{
    use HasFactory;

    protected $table = 'game_platform_types';

    protected $fillable = [
        'name'
    ];
}
