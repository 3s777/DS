<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Enums\CollectableTypeEnum;
use Illuminate\Support\Facades\Schema;
use Spatie\ViewModels\ViewModel;

class CollectibleMediaViewModel extends ViewModel
{
    public function __construct(
        protected ?string $query
    )
    {
    }

    public function result(): array
    {
        $options = [
            ['value' => '', 'label' => trans_choice('collectible.choose_media', 1), 'disabled' => true]
        ];

        if($this->query) {
dd(array_search(request('depended')[0], array_column(CollectableTypeEnum::cases(), 'name')));
            if(array_search('Book', array_column(CollectableTypeEnum::cases(), 'name'))) {
                dd(5);
            }



            if($this->query) {
                $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
                return $options;
            }
            $dependedModel = request('depended')[1];
            $modelName = CollectableTypeEnum::{$dependedModel}->value;

            $query = $modelName::query()->where('name', 'ilike', "%{$this->query}%")->select('id', 'name');

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

            return $options;
        }

        $options[] = ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true];
        return $options;
    }
}
