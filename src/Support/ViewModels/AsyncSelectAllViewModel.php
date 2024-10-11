<?php

namespace Support\ViewModels;

use Illuminate\Support\Facades\Schema;
use Spatie\ViewModels\ViewModel;

class AsyncSelectAllViewModel extends ViewModel
{
    public function __construct(
        protected $modelName,
        protected string $label,
        protected ?bool $depended = false,
        protected ?string $key = 'id',
        protected ?string $name = 'name'
    )
    {
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => __($this->label), 'disabled' => true]
        ];

        if($this->depended && !request('depended')) {
            $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
            return $options;
        }

        if($this->depended) {
            $query = $this->modelName::query()->select($this->key, $this->name);

            $query->when(request('depended'), function ($q) {
                foreach(request('depended') as $key => $value) {
                    if (Schema::hasColumn($q->getModel()->getTable(), $key) && $value){
                        $q->whereIn($key, explode(',', $value));
                    }
                }
                return $q;
            });

            $models = $query->get();

            foreach ($models as $model) {
                $options[] = ['value' => $model->{$this->key}, 'label' => $model->{$this->name}];
            }

            return $options;
        }

        $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
        return $options;
    }
}
