<?php

namespace Domain\Game\Models;

use App\Models\CollectableItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $table = 'game_developers';
}
