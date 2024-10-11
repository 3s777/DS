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
        protected ?bool $depended = false,
        protected ?string $searchField = 'name',
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

        if($this->query) {
            $query = $this->modelName::query()->where($this->searchField, 'ilike', "%{$this->query}%")->select($this->key, $this->name);

            $query->when(request('depended'), function ($q) {
                foreach(request('depended') as $key => $value) {
                    if (Schema::hasColumn($q->getModel()->getTable(), $key) && $value){
                        $q->whereIn($key, explode(',', $value));
                    }
                }
                return $q;
            });

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
