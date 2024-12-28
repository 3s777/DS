<?php

namespace Support\Traits\Models;

trait HasImages
{
    public function getImagesCollection(): string
    {
        return 'images';
    }

    public function getImagesColumn(): string
    {
        return 'images';
    }

    public function getImages(): array
    {
        if(config('thumbnail.driver') == 'media_library') {
            $images = $this->getMedia($this->getImagesColumn());
            $imagesArr = [];

            if($images) {
                foreach($images as $image) {
                    $imagesArr[] = $image->getPathRelativeToRoot();
                }

                return $imagesArr;
            }

            return [];
        }

        return $this->{$this->getImagesColumn()};
    }
}
