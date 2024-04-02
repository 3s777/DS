<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class ResponsiveImage extends Component
{
    public $imgPath = '';
    /**
     * Create a new component instance.
     */
    public function __construct(public $gameDeveloper, public $sizes, public $thumbs)
    {
        $this->imgPath = pathinfo($this->gameDeveloper->thumb_path);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $thumbSizes = Arr::only($this->gameDeveloper->thumbnailSizes(),$this->thumbs);
        return view('components.ui.responsive-image');
    }
}
