<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

trait HasFeaturedImage
{
    protected static function bootHasFeaturedImage(): void
    {
        static::forceDeleting(function (Model $item) {
            $item->deleteFeaturedImage();
        });
    }

    public function getFeaturedImageCollection(): string
    {
        return 'featured_image';
    }

    public function getFeaturedImageColumn(): string
    {
        return 'featured_image';
    }

    public function getFeaturedImagePath(): string
    {
        return $this->imageManager()->getFeaturedImagePath();
    }

    public function getFeaturedImagePathWebp(): string
    {
        $featuredImagePathInfo = pathinfo($this->getFeaturedImagePath());

        if ($featuredImagePathInfo['filename']) {
            return $featuredImagePathInfo['dirname'].'/'.$featuredImagePathInfo['filename'].'.webp';
        }

        return '';
    }

    protected function addOriginalFeaturedImage(string|UploadedFile $image): string
    {
        $imagePath = $this->addOriginal($image, $this->getFeaturedImageCollection());
        $this->{$this->getFeaturedImageColumn()} = $imagePath;
        $this->save();
        return $imagePath;
    }

    public function addFeaturedImageWithThumbnail(null|string|UploadedFile $image, ?array $specialSizes = []): string
    {
        if ($image) {
            $imageFullPath = $this->addOriginalFeaturedImage($image);
            $this->generateFullSizes($imageFullPath);
            $this->generateThumbnails($imageFullPath, $specialSizes);
        }

        return $imageFullPath ?? '';
    }

    public function updateFeaturedImage(null|string|UploadedFile $newFeaturedImage, ?bool $oldFeaturedImage = true, $sizes = []): void
    {
        if (!$oldFeaturedImage && !$newFeaturedImage) {
            $this->deleteFeaturedImage();
        }

        if ($newFeaturedImage) {
            $this->deleteFeaturedImage();

            $this->addFeaturedImageWithThumbnail(
                $newFeaturedImage,
                $sizes
            );
        }
    }

    public function deleteFeaturedImage(): void
    {
        $this->imageManager()->deleteFeaturedImage();
        $this->{$this->getFeaturedImageColumn()} = null;
        $this->save();
    }
}
