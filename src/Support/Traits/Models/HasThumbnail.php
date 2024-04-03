<?php

namespace Support\Traits\Models;

use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Support\MediaLibrary\MediaPathGenerator;

trait HasThumbnail
{
    abstract protected function thumbnailDir(): string;

    abstract public function thumbnailSizes(): array;

    public function thumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function thumbnailStorage(): Filesystem
    {
        return Storage::disk('images');
    }

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail', [
            'size' => $size,
            'dir' => $this->thumbnailDir(),
            'method' => $method,
            'file' => File::basename('test-4.jpg')
//            'file' => File::basename($this->{$this->thumbnailColumn()})
        ]);
    }

    public function generateMediaPath(string $filename): string
    {
        $mediaCreatedDate = Carbon::make($this->created_at);
        $filePath = pathinfo($filename);

        return $this->thumbnailDir().'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .$filePath['filename'].'/';
    }

    protected function addOriginalWithMediaLibrary(UploadedFile $image, $collectionName): string
    {
        $media = $this->addMedia($image)
            ->toMediaCollection($collectionName, 'images');
        $mediaPath = app(MediaPathGenerator::class)->getPath($media);

        $this->{$this->thumbnailColumn()} = $mediaPath.$media->file_name;
        $this->save();

        return $mediaPath.$media->file_name;
    }

    protected function addOriginal(UploadedFile $image): string
    {
        // TODO upload image without MediaLibrary
//        $imageDir = $this->generateMediaPath($imageFileName);
        return $image;
    }

    public function generateThumbnails($imageFullPath, $specialSizes): void
    {
        $defaultThumbnails = $this->thumbnailSizes();

        $imagePathInfo = pathinfo($imageFullPath);

        if($defaultThumbnails) {

            $filteredThumbs = ($specialSizes) ? Arr::only($defaultThumbnails, $specialSizes) : $defaultThumbnails;

            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/webp');
//            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/'.$imagePathInfo['extension']);

            foreach($filteredThumbs as $thumb) {

                $webpThumbDir = $imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1];
//                $originalThumbDir = $imagePathInfo['dirname'].'/'.$imagePathInfo['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $this->thumbnailStorage()->makeDirectory($webpThumbDir);
//                $this->thumbnailStorage()->makeDirectory($originalThumbDir);

                GenerateSmallThumbnailsJob::dispatch($imageFullPath, $thumb[0], $thumb[1], $webpThumbDir);
            }
        }
    }

    public function generateFullSizes(string $imageFullPath): void
    {
        // Generate full image 2048, 100% quality
        GenerateThumbnailJob::dispatch($imageFullPath, 2048, false);

        // Generate original extension image 1200, 80% quality for webp alternative
        GenerateThumbnailJob::dispatch($imageFullPath, 1200, false, 80, 'fallback');

        // Generate webp image 75 quality full size
        GenerateThumbnailJob::dispatch($imageFullPath, 2048, true, 75);
    }

    public function generateThumbnail($imagePath, $size, $quality)
    {

    }

    public function addImageWithThumbnail(UploadedFile $image,
                                          string $collectionName = 'default',
                                          array $specialSizes = []): void
    {
        if(config('thumbnail.driver') == 'media_library') {
            $imageFullPath = $this->addOriginalWithMediaLibrary($image, $collectionName);
        } else {
            $imageFullPath = $this->addOriginal($image);
        }

        $this->generateFullSizes($imageFullPath);

        $this->generateThumbnails($imageFullPath, $specialSizes);
    }
}
