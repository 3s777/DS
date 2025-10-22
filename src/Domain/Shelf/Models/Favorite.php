<?php

namespace Domain\Shelf\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Support\Traits\Models\HasCollector;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasImage;
use Tests\Traits\HasFilters;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    use HasSlug;
    use HasCollector;
    use HasImage;

    protected function imagesDir(): string
    {
        // TODO: Implement imagesDir() method.
        // TODO: Implement imagesDir() method.
    }

    public function thumbnailSizes(): array
    {
        // TODO: Implement thumbnailSizes() method 1.
        // TODO: Implement thumbnailSizes() method 1.
    }
}
