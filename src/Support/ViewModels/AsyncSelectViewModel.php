<?php

namespace Support\ViewModels;

use Illuminate\Support\Facades\Schema;
use Spatie\ViewModels\ViewModel;

class AsyncSelectViewModel extends ViewModel
{
    public function __construct(
        protected ?string $query,
        protected $modelName,
        protected string $label,
        protected ?array $depended = null
    )
    {
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => __($this->label), 'disabled' => true]
        ];

        if($this->query) {
            $query = $this->modelName::query()->where('name', 'ilike', "%{$this->query}%")->select('id', 'name');

            $query->when(request('depended'), function ($q) {
                foreach(request('depended') as $key => $depended) {
                    if (Schema::hasColumn($q->getModel()->getTable(), $key)){
                        $q->where($key, $depended);
                    }
                }
                return $q;
            });

            $models = $query->limit(10)->get();

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
