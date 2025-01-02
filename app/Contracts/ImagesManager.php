<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImagesManager
{
    public function addOriginal(
        UploadedFile $image,
        ?string $collectionName,
        ?string $type
    ): string;


    public function deleteAllThumbnails(): void;
}
