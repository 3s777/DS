<?php

namespace Domain\Game\Models;

use Database\Factories\GamePublisherFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePublisher extends Model
{
    use HasFactory;

    protected $table = 'game_publishers';

    protected static function newFactory(): GamePublisherFactory
    {
        return GamePublisherFactory::new();
    }

}
