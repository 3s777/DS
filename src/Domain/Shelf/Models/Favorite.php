<?php

namespace Domain\Shelf\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasSlug;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    use HasSlug;
}
