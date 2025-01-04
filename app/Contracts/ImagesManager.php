<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImagesManager
{
    public function add(
        UploadedFile $image,
        ?string $collectionName
    ): string;


    public function deleteFeaturedImage(): void;

    public function getFeaturedImagePath(): string;

    public function getImagesPath(): array;
}
