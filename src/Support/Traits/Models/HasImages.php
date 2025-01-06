<?php

namespace Support\Traits\Models;

use Illuminate\Http\UploadedFile;

trait HasImages
{
    public function getImagesCollection(): string
    {
        return 'images';
    }

    public function getImagesColumn(): string
    {
        return 'images';
    }

    protected function addOriginalImages(UploadedFile $image): string
    {
        $imagePath = $this->addOriginal($image, $this->getImagesColumn());

        $images = $this->{$this->getImagesColumn()};
        if (!$images) {
            $images = [];
        }
        $images[] = $imagePath;

        $this->{$this->getImagesColumn()} = $images;

        $this->save();
        return $imagePath;
    }

    public function addImagesWithThumbnail(?UploadedFile $image, ?array $specialSizes): void
    {
        if($image) {
            $imageFullPath = $this->addOriginalImages($image);
            $this->generateFullSizes($imageFullPath);
            $this->generateThumbnails($imageFullPath, $specialSizes);
        }
    }

    public function getImages(): array
    {
        return $this->imageManager()->getImagesPath();
    }

    public function deleteImageByPath(?string $path): void
    {
        dd($path);
    }

    public function updateImages($newImages, $forDelete, $sizes) {
        $this->deleteImageByPath($forDelete);
    }
}
