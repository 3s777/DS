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

    public function add(UploadedFile $image, ?string $collectionName): string
    {
        // TODO upload image without MediaLibrary
        // $imageDir = $this->generateMediaPath($imageFileName);
        return '';
    }

    public function deleteFeaturedImage(): void
    {
//        if($this->{$this->getThumbnailColumn()}) {
//            $imagePathInfo = pathinfo($this->{$this->getThumbnailColumn()});
//            $this->imagesStorage()->delete($imagePathInfo['dirname']);
//        }
    }

    public function getFeaturedImagePath(): string
    {
        return $this->model->{$this->model->getFeaturedImageColumn()};
    }

    public function getImagesPath(): array
    {
        return $this->model->{$this->model->getImagesColumn()};
    }
}
