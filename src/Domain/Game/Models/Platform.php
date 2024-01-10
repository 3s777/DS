<?php

namespace Domain\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $table = 'game_platforms';

    protected $fillable = [
        'name',
        'parent_id',
        'description'
    ];
}
