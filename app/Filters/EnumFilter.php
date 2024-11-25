<?php

namespace App\Filters;

use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class EnumFilter extends AbstractFilter
{
    use Makeable;

    protected ?string $enum;
    protected mixed $callbackPreparedValues;

    public function __construct(
        string $title,
        string $key,
        string $table,
        string $enum,
        ?string $field = null,
        ?string $placeholder = null,
        ?callable $callbackPreparedValues = null,
    )
    {
        parent::__construct($title, $key, $table, $field, $placeholder);

        $this->setEnum($enum);

        $this->setCallbackPreparedValues($callbackPreparedValues);
    }

    public function setEnum(string $enum): static
    {
        $this->enum = $enum;
        return $this;
    }

    private function setCallbackPreparedValues(?callable $callback): static
    {
        $this->callbackPreparedValues = $callback;
        return $this;
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (Builder $query) {
            if(is_array($this->requestValue())) {
                $query->whereIn($this->table.'.'.$this->field, $this->requestValue());
            } else {
                $query->where($this->table.'.'.$this->field, $this->requestValue());
            }
        });
    }

    public function preparedValues(): string|array
    {
        if($this->callbackPreparedValues) {
            return call_user_func($this->callbackPreparedValues, $this->requestValue());
        }

        if(is_array($this->requestValue())) {
            $selected = [];
            if (class_exists($this->enum)) {
                foreach ($this->requestValue() as $key => $value) {
                    $selected[$key] = $this->enum::tryFrom($value)?->name() ?? '';
                }
            }

            return $selected;
        }

        return $this->enum::tryFrom($this->requestValue())?->name() ?? '';
    }

    public function options() {
        if (class_exists($this->enum)) {
            return $this->enum::cases();
        }

        return [];
    }

    public function view(): string
    {
        return '';
    }
}
