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
use Support\Facades\Image;

class ResponsiveImage extends Component
{
    public array $imgPathInfo;

    // TODO: add cache for $storage->exist
    public function __construct(
        public Model $model,
        public array $imageSizes,
        public string $sizes,
        public string $path = '',
        public bool $placeholder = true,
        public ?int $width = null,
        public ?int $height = null,
        public bool $wrapper = false,
        public string $wrapperClass = ''
    ) {
        $this->imgPathInfo = pathinfo($this->path);

        $this->imageSizes = Arr::only($this->model->thumbnailSizes(), $this->imageSizes);
    }

    public function fallbackSource(): string
    {
        return $this->imgPathInfo['dirname'].'/'.$this->imgPathInfo['filename'].'_fallback.'.$this->imgPathInfo['extension'];
    }

    /*    Check thumbnail sizes images by path and create if not isset */
    public function checkAndCreateImageSizes(array $imageSizes): void
    {
        $storage = Storage::disk('images');

//        $manager = new ImageManager(new Driver());
//        $manager = new Image();

        if (!$storage->exists($this->imgPathInfo['dirname'].'/webp/'.$this->imgPathInfo['filename'].'.webp')) {

            $mainWebpImageDir = $this->imgPathInfo['dirname'] . '/webp/';
            $storage->makeDirectory($mainWebpImageDir);

            $mainImage = Image::read($storage->path($this->path));

            $mainImage
                ->scaleDown('2048')
                ->toWebp(config('images.webp_quality'))
                ->save($storage->path($mainWebpImageDir . '/' . $this->imgPathInfo['filename'] . '.webp'));
        }

        foreach ($imageSizes as $size) {
            if (!$storage->exists($this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1].'/'.$this->imgPathInfo['filename'].'.webp')) {

                $webpImageDir = $this->imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1];
                $storage->makeDirectory($webpImageDir);

                $image = Image::read($storage->path($this->path));

                $image
                    ->scaleDown($size[0], $size[1])
                    ->toWebp(config('images.webp_quality'))
                    ->save($storage->path($webpImageDir.'/'.$this->imgPathInfo['filename'].'.webp'));
            }
        }
    }

    public function shouldRender(): bool
    {
        $storage = Storage::disk('images');

        if (!$this->path && !$this->placeholder) {
            return false;
        }

        return !$this->path || $storage->exists($this->path);
    }

    public function render(): View|Closure|string
    {
        if ($this->path) {
            $this->checkAndCreateImageSizes($this->imageSizes);
        }

        return view('components.ui.responsive-image');
    }
}
