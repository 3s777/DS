<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class RelationMultipleFilter extends AbstractFilter
{
    use Makeable;

    public array $relatedModels;
    protected string $relation;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        ?string $placeholder = null,
        ?string $relation = null
    )
    {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setRelation($relation);
        $this->setRelatedModel();
    }

    public function setRelation(string $relation): static
    {
        $this->relation = $relation;
        return $this;
    }

    public function setField(string|null $field): static
    {
        $this->field = 'id';

        if($field) {
            $this->field = $field;
        }

        return $this;
    }

    public function setRelatedModel(): static
    {
        $this->relatedModels = [];

        if(request()->input('filters.'.$this->key)) {
            $relatedCollection = $this->relation::select(['id', 'name'])->whereIn('id', $this->requestValue())->get();

            $this->relatedModels = array_map(function ($value) use ($relatedCollection) {
                return $relatedCollection->find($value);
            }, request()->input('filters.'.$this->key) );
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->whereHas($this->key, function (Builder $query) {
                $query->whereIn($this->table.'.'.$this->field,   $this->requestValue());
            });
        });
    }

    public function preparedValues(): mixed
    {
        if(!empty($this->relatedModels)) {
            $names = [];

            foreach($this->relatedModels as $key => $model) {
                if($model) {
                    $names[$key] = $model->name;
                }
            }

            return $names;
        }

        return '';
    }

    public function view(): string
    {
        //        return 'components.common.filters.search';
        return '';
    }
}
