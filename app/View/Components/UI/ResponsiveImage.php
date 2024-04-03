<?php

namespace App\View\Components\UI;

use App\Models\Media;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Support\MediaLibrary\MediaPathGenerator;

class ResponsiveImage extends Component
{
    public string $imgPath;
    public array $imgPathInfo;

    public function __construct(
        public Model $model,
        public array $thumbs,
        public string $sizes,
        public string $path,
        public Media|null $media = null
    )
    {
        if(config('thumbnail.driver') == 'media_library') {

            $mediaPath = app(MediaPathGenerator::class)->getPath($this->media);

            $this->imgPath = $mediaPath.$this->media->file_name;
        } else {
            $this->imgPath = $this->model->thumbnail;
        }


        $this->imgPathInfo = pathinfo($this->imgPath);
    }

    public function fallbackSource() {
        return $this->imgPathInfo['dirname'].'/'.$this->imgPathInfo['filename'].'_fallback.'.$this->imgPathInfo['extension'];
    }

    public function render(): View|Closure|string
    {
        $storage = Storage::disk('images');

        $thumbSizes = Arr::only($this->model->thumbnailSizes(),$this->thumbs);

        foreach($thumbSizes as $size) {
            if(!$storage->exists($this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1].'/'.$this->imgPathInfo['filename'].'.webp'))
            {
                $webpThumbDir = $this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1];
                $storage->makeDirectory($webpThumbDir);

                $manager = new ImageManager(new Driver());
                $image = $manager->read($storage->path($this->imgPath));

                $image
                    ->scaleDown($size[0], $size[1])
                    ->toWebp(75)
                    ->save($storage->path($webpThumbDir.'/'.$this->imgPathInfo['filename'].'.webp'));
            }
        }

        return view('components.ui.responsive-image', compact(['thumbSizes']));
    }
}
