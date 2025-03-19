<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class SearchFilter extends AbstractFilter
{
    use Makeable;

    protected ?array $alternativeFields;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        ?string $placeholder = null,
        ?array $alternativeFields = null
    ) {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setAlternativeFields($alternativeFields);
    }

    protected function setField(string|null $field): static
    {
        $this->field = 'name';

        if ($field) {
            $this->field = $field;
        }

        return $this;
    }

    protected function setAlternativeFields(?array $alternativeFields): static
    {
        $this->alternativeFields = $alternativeFields;
        return $this;
    }

    public function placeholder(string $key = ''): string|array|null
    {
        if ($this->placeholder) {
            return $this->placeholder;
        }

        return $this->title;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field, 'ILIKE', '%'.$this->requestValue().'%');
            if ($this->alternativeFields) {
                foreach ($this->alternativeFields as $field) {
                    $query->orWhere($this->table.'.'.$field, 'ILIKE', '%'.$this->requestValue().'%');
                }
            }
        });
    }

    public function preparedValues(): string
    {
        return str($this->requestValue())->value();
    }

    public function view(): string
    {
        return 'components.common.filters.search';
    }
}
