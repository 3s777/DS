<?php

namespace Admin\Shelf\ViewModels;

use Spatie\ViewModels\ViewModel;

use const Domain\Shelf\ViewModels\CollectableTypeEnum;
use const Domain\Shelf\ViewModels\value;

class CollectibleMediaViewModel extends ViewModel
{
    protected ?string $query;
    protected string $dependedModel;

    public function __construct($query)
    {
        $this->query = $query;
        $this->dependedModel = request('depended')['media'];
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => trans_choice('collectible.choose_media', 1), 'disabled' => true]
        ];

        if (!$this->query) {
            $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
            return $options;
        }

        $modelName = CollectableTypeEnum::{$this->dependedModel}->value;

        $models = $modelName::query()
            ->where('name', 'ilike', "%{$this->query}%")
            ->orWhere('alternative_names', 'ilike', "%{$this->query}%")
            ->select('id', 'name')
            ->limit(10)
            ->get();

        foreach ($models as $model) {
            $options[] = ['value' => $model->id, 'label' => $model->name];
        }

        return $options;
    }
}
