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
        protected ?bool $depended = false,
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

        if($this->depended && request('all')) {
            $query = $this->modelName::query()->select('id', 'name');

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
                $options[] = ['value' => $model->id, 'label' => $model->name];
            }

            return $options;
        }


            if($this->query) {
                $query = $this->modelName::query()->where('name', 'ilike', "%{$this->query}%")->select('id', 'name');

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
                    $options[] = ['value' => $model->id, 'label' => $model->name];
                }

//                if($models->isEmpty()) {
//                    $options[] = ['value' => 'not_found', 'label' => 'xssd', 'disabled' => true];
//                }
                return $options;
            }




        $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
        return $options;
    }
}
