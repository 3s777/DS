<?php

namespace Support\ViewModels;

use Spatie\ViewModels\ViewModel;

class AsyncSelectViewModel extends ViewModel
{
    public function __construct(protected null|string $query, protected $modelName, protected string $label)
    {
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => __($this->label), 'disabled' => true]
        ];

        if($this->query) {
            $models = $this->modelName::where('name', 'ilike', "%{$this->query}%")->select('id', 'name')->limit(10)->get();

            foreach ($models as $model) {
                $options[] = ['value' => $model->id, 'label' => $model->name];
            }

            if($models->isEmpty()) {
                $options[] = ['value' => '', 'label' => __('common.not_found'), 'disabled' => true];
            }
        }

        return $options;
    }
}
