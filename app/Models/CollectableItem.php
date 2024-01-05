<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectableItem extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'properties'
    ];

//    protected $casts = [
//      'properties' => 'array'
//    ];
}
