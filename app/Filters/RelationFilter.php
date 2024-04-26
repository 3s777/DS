<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class RelationFilter extends AbstractFilter
{
    use Makeable;

    public ?Model $relatedModel;
    protected string $relation;

    public function __construct(string $title, string $key, string $table, ?string $field = null, ?string $relation = null)
    {
        parent::__construct($title, $key, $table, $field);

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
        $this->relatedModel = null;

        if(request()->input('filters.'.$this->key)) {
            $this->relatedModel = $this->relation::find($this->requestValue());
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field,  $this->requestValue());
        });
    }

    public function preparedValues(): string
    {
        if($this->relatedModel) {
            return $this->relatedModel->name;
        }

        return '';
    }

    public function view(): string
    {
//        return 'components.common.filters.search';
        return '';
    }
}
