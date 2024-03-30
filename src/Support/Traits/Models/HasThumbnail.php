<?php

namespace Support\Traits\Models;

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

    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
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

        return $this->modelThumbDir().'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .$filePath['filename'].'/';
    }

    protected function addOriginalWithMediaLibrary(UploadedFile $image, $collectionName): \Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        $media = $this->addMedia($image)
            ->toMediaCollection($collectionName, 'images');

        $mediaPath = app(MediaPathGenerator::class)->getPath($media);

        $this->thumb_path = $mediaPath.$media->file_name;
        $this->save();

        return $media;
    }

    protected function addOriginal(UploadedFile $image): string
    {
        // TODO upload image without MediaLibrary
        return '';
    }

    public function addImageWithThumbnail(UploadedFile $image, string $collectionName = 'default', array $thumbSizes = null): void
    {

        if(config('thumbnail.driver') == 'media_library') {
            $media = $this->addOriginalWithMediaLibrary($image, $collectionName);
            $mediaPath = app(MediaPathGenerator::class)->getPath($media);
            $imageFileName = $media->file_name;
        } else {
            $imageFileName = $this->addOriginal($image);
            $mediaPath = $this->generateMediaPath($imageFileName);
        }


        $storage = Storage::disk('images');

        $filePath = pathinfo($mediaPath.$imageFileName);

        $manager = new ImageManager(new Driver());

        $image = $manager->read($storage->path($mediaPath.$imageFileName));
        $image->save($storage->path($mediaPath.$filePath['filename'].'_original.'.$filePath['extension']), 85);
        $image->scaleDown(2048)->save($storage->path( $this->thumb_path));

        $originalImage = clone $image;
        $originalImage->save($storage->path($mediaPath.$filePath['filename'].'_original.'.$filePath['extension']), 85);

        $webpImage = clone $image;
        $webpImage->toWebp(75)->save($storage->path($mediaPath.$filePath['filename']).'.webp');



        if($this->thumbs) {

            $filteredThumbs = ($thumbSizes) ? Arr::only($this->thumbs, $thumbSizes) : $this->thumbs;

            $storage->makeDirectory($mediaPath.'/webp');
            $storage->makeDirectory($mediaPath.'/'.$filePath['extension']);

            foreach($filteredThumbs as $thumb) {

                $webpThumbDir = $mediaPath.'/webp/'.$thumb[0].'x'.$thumb[1];
                $originalThumbDir = $mediaPath.'/'.$filePath['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $storage->makeDirectory($webpThumbDir);
                $storage->makeDirectory($originalThumbDir);

                $thumbImage = clone $image;
                $thumbImage->scale($thumb[0], $thumb[1])->encodeByExtension(quality: 85)->save($storage->path($originalThumbDir.'/'.$filePath['filename'].'.'.$filePath['extension']));

                $thumbWebpImage = clone $image;
                $thumbWebpImage->scale($thumb[0], $thumb[1])->toWebp(75)->save($storage->path($webpThumbDir.'/'.$filePath['filename'].'.webp'));

            }
        }
    }

}
