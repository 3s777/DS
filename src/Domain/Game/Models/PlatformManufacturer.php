<?php

namespace Domain\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformManufacturer extends Model
{
    use HasFactory;

    protected $table = 'game_platform_manufacturers';

    protected $fillable = [
        'name'
    ];
}
