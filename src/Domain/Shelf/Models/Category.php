<?php

namespace Domain\Shelf\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasSlug;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
}
