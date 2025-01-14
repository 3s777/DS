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

    public function addImagesWithThumbnail(?UploadedFile $image, ?array $specialSizes): string
    {
        if($image) {
            $imageFullPath = $this->addOriginalImages($image);
            $this->generateFullSizes($imageFullPath);
            $this->generateThumbnails($imageFullPath, $specialSizes);
        }

        return $imageFullPath ?? '';
    }

    public function getImages(): array
    {
        return $this->imageManager()->getImagesPath();
    }

    public function deleteImages(?string $paths): void
    {
        // create array from paths string, implode by ',' and delete empty

//        dd(
//            (array_filter(explode(',', $paths))),
//        );
        $pathArr = (array_filter(explode(',', $paths)));
        $images = $this->{$this->getImagesColumn()};

        foreach ($pathArr as $path) {
            $this->imageManager()->deleteByPath($path);

            if (($key = array_search($path, $images)) !== false) {
                unset($images[$key]);
            }
        }

        $this->{$this->getImagesColumn()} = $images;

        $this->save();
    }

    public function updateImages(?array $newImages, ?string $forDelete, array $sizes): void
    {
        if($forDelete) {
            $this->deleteImages($forDelete);
        }

        if($newImages) {
            foreach ($newImages as $image) {
                $this->addImagesWithThumbnail(
                    $image,
                    $sizes,
                );
            }
        }
    }
}
