<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Enums\CollectibleTypeEnum;
use Illuminate\Support\Facades\Blade;
use Spatie\ViewModels\ViewModel;

class KitItemConditionViewModel extends ViewModel
{
    public function __construct(private string $model, private string $media)
    {
    }

    public function html()
    {
        $modelClass = CollectibleTypeEnum::{$this->model}->value;
        $media = $modelClass::find($this->media);

        $html = '';

        foreach($media->kitItems as $kitItem) {
//            $html .= ViewFacade::make("components.ui.star-rating")
//                ->with('name', $kitItem->slug)
//                ->with('title', $kitItem->name);

//            $html .= view('components.ui.star-rating',
//                ['name' => $kitItem->slug,
//                'title' => $kitItem->name]
//            );
            $html .= Blade::render(
                '<x-ui.star-rating :name="$name" :title="$title" input-name="kit_conditions[{{ $name }}]" class="admin__conditions-item" />',
                ['name' => $kitItem->id, 'title' => $kitItem->name]
            );
        }

        return $html;
    }
}
