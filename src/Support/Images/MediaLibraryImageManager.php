<?php

namespace Support\Images;

use App\Contracts\ImagesManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaLibraryImageManager implements ImagesManager
{
    public function __construct(public Model $model)
    {
    }

    public function addOriginal(UploadedFile $image, ?string $collectionName, ?string $type): string
    {
        $media = $this->model->addMedia($image)
            ->toMediaCollection($collectionName, 'images');
        //        $mediaPath = app(MediaPathGenerator::class)->getPath($media);
        //        $this->{$this->getThumbnailColumn()} = $mediaPath.$media->file_name;
        if($type === $this->model->getThumbnailColumn()) {
            $this->model->{$this->model->getThumbnailColumn()} = $media->getPathRelativeToRoot();
        }

        if(method_exists($this->model, 'getImagesColumn')) {
            if($type === $this->model->getImagesColumn()) {
                $images = $this->model->{$this->model->getImagesColumn()};

                if (!$images) {
                    $images = [];
                }

                $images[] = $media->getPathRelativeToRoot();

                $this->{$this->model->getImagesColumn()} = $images;
            }
            $this->model->save();
        }

        return $media->getPathRelativeToRoot();
    }

    public function deleteAllThumbnails(): void
    {
        $media = $this->model->getFirstMedia($this->model->getThumbnailColumn());
        $media?->forceDelete();
    }
}
