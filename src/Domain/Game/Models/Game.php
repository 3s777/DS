<?php

namespace Domain\Game\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $casts = [
        'alternative_names' => 'array'
    ];

    public function publishers()
    {
        return $this->belongsToMany(GamePublisher::class, 'game_game_publisher', 'game_id', 'game_publisher_id');
    }

    public function developers()
    {
        return $this->belongsToMany(GameDeveloper::class, 'game_game_developer', 'game_id', 'game_developer_id');
    }

    public function genres()
    {
        return $this->belongsToMany(GameGenre::class, 'game_game_genre', 'game_id', 'game_genre_id');
    }

    public function platforms()
    {
        return $this->belongsToMany(GamePlatform::class, 'game_game_platform', 'game_id', 'game_platform_id');
    }
}
