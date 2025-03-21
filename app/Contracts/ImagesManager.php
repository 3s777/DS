<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImagesManager
{
    public function add(
        string|UploadedFile $image,
        ?string $collectionName
    ): string;

    public function deleteByPath(string $path): void;

    public function deleteFeaturedImage(): void;

    public function getFeaturedImagePath(): string;

    public function getImagesPath(): array;
}
