<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ResponsiveImage extends Component
{
    public array $imgPathInfo;

    public function __construct(
        public Model $model,
        public array $thumbs,
        public string $sizes,
        public ?string $path,
        public bool $placeholder = true
    )
    {
        $this->imgPathInfo = pathinfo($this->path);
    }

    public function fallbackSource(): string
    {
        return $this->imgPathInfo['dirname'].'/'.$this->imgPathInfo['filename'].'_fallback.'.$this->imgPathInfo['extension'];
    }

    /*    Check thumbnail sizes images by path and create if not isset */
    public function checkAndCreateThumbnailSizes(array $thumbnailSizes): void
    {
        $storage = Storage::disk('images');
        foreach($thumbnailSizes as $size) {
            if(!$storage->exists($this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1].'/'.$this->imgPathInfo['filename'].'.webp'))
            {
                $webpThumbDir = $this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1];
                $storage->makeDirectory($webpThumbDir);

                $manager = new ImageManager(new Driver());
                $image = $manager->read($storage->path($this->path));

                $image
                    ->scaleDown($size[0], $size[1])
                    ->toWebp(config('thumbnail.webp_quality'))
                    ->save($storage->path($webpThumbDir.'/'.$this->imgPathInfo['filename'].'.webp'));
            }
        }
    }

    public function shouldRender(): bool
    {
        if(!$this->path && !$this->placeholder) {
            return false;
        }

        return true;
    }

    public function render(): View|Closure|string
    {
        $thumbSizes = Arr::only($this->model->thumbnailSizes(),$this->thumbs);

        if($this->path) {
            $this->checkAndCreateThumbnailSizes($thumbSizes);
        }

        return view('components.ui.responsive-image', compact(['thumbSizes']));
    }
}
