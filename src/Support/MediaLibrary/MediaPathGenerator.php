<?php

namespace Support\MediaLibrary;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class MediaPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $mediaCreatedDate = Carbon::make($media->created_at);
        $filePath = pathinfo($media->file_name);

        return Str::snake(class_basename($media->model_type)).'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .$filePath['filename'].'/';

        //          return $media->dirname;
        //        $media->load('model');
        //        $mediaCreatedDate = Carbon::make($media->model->created_at);
        //        $filePath = pathinfo($media->file_name);
        //
        //        return $media->model->thumbnailDir().'/'
        //            .$mediaCreatedDate->format('Y').'/'
        //            .$mediaCreatedDate->format('m').'/'
        ////            .$media->getKey().'/';
        //            .$filePath['filename'].'/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'responsive/';
    }
}
