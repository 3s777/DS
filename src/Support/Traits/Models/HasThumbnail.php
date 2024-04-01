<?php

namespace Support\Traits\Models;

use App\Jobs\GenerateThumbnailJob;
use App\Models\Media;
use Carbon\Carbon;
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

    public function thumbnailStorage(): \Illuminate\Contracts\Filesystem\Filesystem
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

    protected function generateMediaPath($filename) {
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
        $this->save();
        return $mediaPath.$media->file_name;
    }

    protected function addOriginal(UploadedFile $image): string
    {
        // TODO upload image without MediaLibrary
//        $imageDir = $this->generateMediaPath($imageFileName);
        return '';
    }

    public function generateThumbnails($imageFullPath, $specialSizes): void
    {
        $defaultThumbnails = $this->thumbnailSizes();

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->thumbnailStorage()->path($imageFullPath));

        $imagePathInfo = pathinfo($imageFullPath);

        if($defaultThumbnails) {

            $filteredThumbs = ($specialSizes) ? Arr::only($defaultThumbnails, $specialSizes) : $defaultThumbnails;

            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/webp');
            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/'.$imagePathInfo['extension']);

            foreach($filteredThumbs as $thumb) {

                $webpThumbDir = $imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1];
                $originalThumbDir = $imagePathInfo['dirname'].'/'.$imagePathInfo['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $this->thumbnailStorage()->makeDirectory($webpThumbDir);
                $this->thumbnailStorage()->makeDirectory($originalThumbDir);

                $thumbImage = clone $image;
                $thumbImage
                    ->scaleDown($thumb[0], $thumb[1])
                    ->save($this->thumbnailStorage()->path($originalThumbDir.'/'.$imagePathInfo['filename'].'.'.$imagePathInfo['extension']));

                $thumbWebpImage = clone $image;
                $thumbWebpImage
                    ->scaleDown($thumb[0], $thumb[1])
                    ->toWebp()
                    ->save($this->thumbnailStorage()->path($webpThumbDir.'/'.$imagePathInfo['filename'].'.webp'));
            }
        }
    }

    public function generateFullSizes($imageFullPath)
    {
        $imagePathInfo = pathinfo($imageFullPath);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->thumbnailStorage()->path($imageFullPath));
//        $image->scaleDown(2048)->save($this->thumbnailStorage()->path($imageFullPath));

        GenerateThumbnailJob::dispatch($imageFullPath);

        $originalImage = clone $image;
        $originalImage->scaleDown(1200)
            ->encodeByExtension(quality: 80)
            ->save($this->thumbnailStorage()->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_original.'.$imagePathInfo['extension']), 85);

        $webpImage = clone $image;
        $webpImage->toWebp(75)->save($this->thumbnailStorage()->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename']).'.webp');
    }

    public function addImageWithThumbnail(UploadedFile $image, string $collectionName = 'default', array $specialSizes = []): void
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
