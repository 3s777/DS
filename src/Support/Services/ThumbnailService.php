<?php

namespace Support\Services;

use Illuminate\Support\Facades\Storage;
use Support\Facades\Image;
use Intervention\Image\Image as InterventionImage;

class ThumbnailService
{
    public function generateSmallWebp(
        string $fullPath,
        string $thumbDir,
        int $width,
        ?int $height = null,
        string $storageDisk = 'images'
    ): ?InterventionImage
    {
        $storage = Storage::disk($storageDisk);
        $imagePathInfo = pathinfo($fullPath);

        if (!$storage->exists($thumbDir))
        {
            $storage->makeDirectory($thumbDir);
        }

        $image = Image::read($storage->path($fullPath));

        //
        return $image
            ->scale(width: $width)
//            ->scaleDown($width, $height)
            ->toWebp(config('images.webp_quality'))
            ->save($storage->path($thumbDir.'/'.$imagePathInfo['filename'].'.webp'));
    }

    public function generateFullSize(
        string $fullPath,
        ?int $width = null,
        bool $isWebp = false,
        int $quality = 100,
        ?string $prefix = null,
        string $storageDisk = 'images',
        bool $isJpg = true
    ): InterventionImage
    {
        $storage = Storage::disk($storageDisk);
        $imagePathInfo = pathinfo($fullPath);
        $extension = $imagePathInfo['extension'];

        $image = Image::read($storage->path($fullPath));

        if ($width) {
            $image->scale($width);
        }

        if ($isWebp) {
            $image->toWebp($quality)
                ->save($storage->path($imagePathInfo['dirname'].'/webp/'.$imagePathInfo['filename']).'.webp');
        }

        if ($isJpg) {
            if (strtolower($imagePathInfo['extension']) !== 'jpg') {
                $image->toJpeg($quality);
                $extension = 'jpg';
            }
        }

        if ($prefix) {
            $image->save($storage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_'.$prefix.'.'.$extension), $quality);
        }

        if (!$isWebp && !$prefix) {
//                $fullPath
            $image->save(
                $storage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'.'.$extension),
                $quality
            );
        }

        return $image;
    }
}
