<?php

namespace App\View\Components\Ui;

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
        public array $imageSizes,
        public string $sizes,
        public string $path = '',
        public bool $placeholder = true
    ) {
        $this->imgPathInfo = pathinfo($this->path);
    }

    public function fallbackSource(): string
    {
        return $this->imgPathInfo['dirname'].'/'.$this->imgPathInfo['filename'].'_fallback.'.$this->imgPathInfo['extension'];
    }

    /*    Check thumbnail sizes images by path and create if not isset */
    public function checkAndCreateImageSizes(array $imageSizes): void
    {
        $storage = Storage::disk('images');

        foreach($imageSizes as $size) {
            if(!$storage->exists($this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1].'/'.$this->imgPathInfo['filename'].'.webp')) {
                $webpImageDir = $this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1];
                $storage->makeDirectory($webpImageDir);

                $manager = new ImageManager(new Driver());
                $image = $manager->read($storage->path($this->path));

                $image
                    ->scaleDown($size[0], $size[1])
                    ->toWebp(config('thumbnail.webp_quality'))
                    ->save($storage->path($webpImageDir.'/'.$this->imgPathInfo['filename'].'.webp'));
            }
        }
    }

    public function shouldRender(): bool
    {
        $storage = Storage::disk('images');


        if(!$this->path && !$this->placeholder) {
            return false;
        }

        if(!$storage->exists($this->path)) {
            return false;
        }

        return true;
    }

    public function render(): View|Closure|string
    {
        $imageSizesFiltered = Arr::only($this->model->thumbnailSizes(), $this->imageSizes);

        if($this->path) {
            $this->checkAndCreateImageSizes($imageSizesFiltered);
        }

        return view('components.ui.responsive-image', compact(['imageSizesFiltered']));
    }
}
