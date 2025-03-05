<?php

namespace App\Filters;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class RelationFilter extends AbstractFilter
{
    use Makeable;

    public array $relatedModel;
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

    protected function setRelation(string $relation): static
    {
        $this->relation = $relation;
        return $this;
    }

    protected function setRelatedModel(): static
    {
        $this->relatedModel = [];

        if(request()->input('filters.'.$this->key)) {
            $model = $this->relation::find($this->requestValue());
            $this->relatedModel = ['key' => $model->id, 'value' => $model->name];
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field, $this->requestValue());
        });
    }

    public function preparedValues(): string
    {
        if($this->relatedModel) {
            return $this->relatedModel['value'];
        }

        return '';
    }

    public function getPreparedOptions()
    {
        return $this->relation::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function view(): string
    {
        //        return 'components.common.filters.search';
        return '';
    }
}
