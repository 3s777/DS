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
        string $relation,
        ?string $field = null,
        ?string $placeholder = null,
    ) {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setRelation($relation);
        $this->setRelatedModel();
    }

    protected function setRelation(string $relation): static
    {
        $this->relation = $relation;
        return $this;
    }

    protected function setRelatedModel(): static
    {
        $this->relatedModels = [];

        //        dd(request()->input('filters'));

        if (request()->input('filters.'.$this->key)) {
            $relatedCollection = $this->relation::select(['id', 'name'])->whereIn('id', $this->requestValue())->get();

            $this->relatedModels = array_map(function ($value) use ($relatedCollection) {
                return $relatedCollection->find($value);
            }, request()->input('filters.'.$this->key));
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->whereHas($this->key, function (Builder $query) {
                $query->whereIn($this->table.'.'.$this->field, $this->requestValue());
            });
        });
    }

    public function preparedValues(): mixed
    {
        if (!empty($this->relatedModels)) {
            $names = [];

            foreach ($this->relatedModels as $key => $model) {
                if ($model) {
                    $names[$key] = $model->name;
                }
            }

            return $names;
        }

        return '';
    }

    public function preparedSelected(): array
    {
        if (!empty($this->relatedModels)) {
            $selected = [];

            foreach ($this->relatedModels as $key => $model) {
                if ($model) {
                    $selected[$model->{$this->field}] = $model->name;
                }
            }

            return $selected;
        }

        return [];
    }

    public function getPreparedOptions(): array
    {
        return $this->relation::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function view(): string
    {
        //        return 'components.common.filters.search';
        return '';
    }
}
