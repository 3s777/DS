<?php

namespace App\Models;

use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectableItem extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'properties'
    ];

    protected $casts = [
      'properties' => 'array'
    ];

    public function developers() {
        return $this->morphedByMany(GameDeveloper::class, 'productable');
    }

    public function publishers() {
        return $this->morphedByMany(GamePublisher::class, 'productable');
    }
}
