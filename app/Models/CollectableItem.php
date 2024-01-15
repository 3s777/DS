<?php

namespace App\Models;

use Domain\Game\Models\Developer;
use Domain\Game\Models\Publisher;
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
        return $this->morphedByMany(Developer::class, 'productable');
    }

    public function publishers() {
        return $this->morphedByMany(Publisher::class, 'productable');
    }
}
