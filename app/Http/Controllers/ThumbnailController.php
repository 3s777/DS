<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ThumbnailController extends Controller
{
   public function __invoke(
       string $dir,
       string $method,
       string $size,
       string $file
   ): BinaryFileResponse
   {

        abort_if(
            !in_array($size, config('thumbnail.allowed_sizes', [])),
            403,
            'Size not allowed'
        );

        $storage = Storage::disk('images');

        $sourcePath = "$dir/$file";
        $sourceWebpPath = "$dir/webp/$file";
        $newDirPath = "$dir/$method/$size";
        $resultPath = "$newDirPath/$file";


       $manager = new ImageManager(
           new Driver()
       );

       $image = $manager->read($storage->path($sourcePath));

       if(!$storage->exists($sourceWebpPath)) {

           $filename = pathinfo($file);



           $image->toWebp(90)
               ->save($storage->path("$dir/webp/".$filename['filename'].".webp"));
       }

        if(!$storage->exists($resultPath)) {
            $storage->makeDirectory($newDirPath);
        }

        if(!$storage->exists($resultPath)) {




            [$w, $h] = explode('x', $size);

//            $image->{$method}($w, $h)->gamma(10.7)->encode()->save($storage->path($newDirPath.'/sd1f.png'));

            $image->{$method}($w, $h)
                ->toJpeg(90)
                ->save($storage->path($resultPath));
        }

        return response()->file($storage->path($resultPath));

   }
}
