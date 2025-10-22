<?php

namespace Domain\Shelf\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasImage;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    use HasSlug;
    use HasImage;

    protected function imagesDir(): string
    {
        // TODO: Implement imagesDir() method.
    }

    public function thumbnailSizes(): array
    {
        // TODO: Implement thumbnailSizes() method.
    }
}
