<?php

namespace App\Filters;

use Domain\Auth\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Support\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Support\Traits\Makeable;

class RelationFilter extends AbstractFilter
{
    use Makeable;

    public $user;

    public function __construct(string $title, string $key, string $table, ?string $field = null)
    {
        parent::__construct($title, $key, $table, $field);

        if(request()->input($field)) {
            $this->selectedModel();
        }

    }

    public function setField(string|null $field): static
    {
        $this->field = 'id';

        if($field) {
            $this->field = $field;
        }

        return $this;
    }

    public function apply(Builder $query): Builder
    {

//        $user = User::find($this->requestValue());
//
//        request()->session()->flash('variableNames', $user->name);

        return $query->when($this->requestValue(), function (Builder $query) {
            $query->where($this->table.'.'.$this->field,  $this->requestValue());
        });
    }



    public function selectedModel()
    {
        $this->user = User::find($this->requestValue());
    }

    public function preparedValues(): string
    {
        if($this->user) {
            return $this->user->name;
        }

        return '';
    }

    public function view(): string
    {
//        return 'components.common.filters.search';
        return '';
    }
}
