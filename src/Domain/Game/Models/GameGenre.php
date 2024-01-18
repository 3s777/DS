<?php

namespace Domain\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGenre extends Model
{
    use HasFactory;

    protected $table = 'game_genres';

    protected $fillable = [
        'name',
        'description'
    ];
}
