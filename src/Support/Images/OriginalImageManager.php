<?php

namespace Support\Images;

use App\Contracts\ImagesManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class OriginalImageManager implements ImagesManager
{
    public function __construct(public Model $model)
    {
    }

    public function addOriginal(UploadedFile $image, ?string $collectionName, ?string $type): string
    {
        // TODO upload image without MediaLibrary
        // $imageDir = $this->generateMediaPath($imageFileName);
        return '';
    }

    public function deleteAllThumbnails(): void
    {
//        if($this->{$this->getThumbnailColumn()}) {
//            $imagePathInfo = pathinfo($this->{$this->getThumbnailColumn()});
//            $this->imageStorage()->delete($imagePathInfo['dirname']);
//        }
    }

    public function getThumbnailPath(): string
    {
        // TODO: Implement getThumbnailPath() method.
    }

    public function getImagesPath(): array
    {
        // TODO: Implement getImagesPath() method.
    }
}
