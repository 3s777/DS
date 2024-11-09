<?php

namespace Support\ViewModels;

use Illuminate\Support\Facades\Schema;
use Spatie\ViewModels\ViewModel;

class AsyncSelectByQueryViewModel extends ViewModel
{
    public function __construct(
        protected ?string $query,
        protected $modelName,
        protected string $label,
        protected ?array $depended = null,
        protected ?string $searchField = 'name',
        protected ?string $key = 'id',
        protected ?string $name = 'name'
    )
    {
    }

    private function setEmpty(): array
    {
        return [
            ['value' => '', 'label' => __($this->label), 'disabled' => true],
            ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true]
        ];
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => __($this->label), 'disabled' => true]
        ];

//        if($this->depended && !request('depended')) {
//            return $this->setEmpty();
//        }


        if($this->depended && $this->query) {
            $dependedKey = array_key_first($this->depended);
            $dependedValue = $this->depended[$dependedKey];

            $query = $this->modelName::query()->where($this->searchField, 'ilike', "%{$this->query}%")->select($this->key, $this->name);

            if (!Schema::hasColumn($query->getModel()->getTable(), $dependedKey) || !$dependedValue) {
                return $this->setEmpty();
            }

            $query->whereIn($dependedKey, explode(',', $dependedValue));

            $models = $query->get();

            foreach ($models as $model) {
                $options[] = ['value' => $model->{$this->key}, 'label' => $model->{$this->name}];
            }

            return $options;
        }


        if($this->query) {
            $query = $this->modelName::query()->where($this->searchField, 'ilike', "%{$this->query}%")->select($this->key, $this->name);

            $models = $query->limit(10)->get();

            foreach ($models as $model) {
                $options[] = ['value' => $model->{$this->key}, 'label' => $model->{$this->name}];
            }

            return $options;
        }

        $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
        return $options;
    }
}
