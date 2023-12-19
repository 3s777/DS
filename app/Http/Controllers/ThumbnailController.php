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

        $realPath = "$dir/$file";
        $newDirPath = "$dir/$method/$size";
        $resultPath = "$newDirPath/$file";



        if(!$storage->exists($resultPath)) {
            $storage->makeDirectory($newDirPath);
        }

        if(!$storage->exists($resultPath)) {
            $manager = new ImageManager(
                new Driver()
            );


            $image = $manager->read($storage->path($realPath));

            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);

            $encoded = $image->toWebp();



            $encoded->save($storage->path($resultPath));


        }

        return response()->file($storage->path($resultPath));

   }
}
