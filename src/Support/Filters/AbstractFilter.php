<?php

namespace Support\Filters;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Stringable;

abstract class AbstractFilter implements Stringable
{
    public function __invoke(Builder $query, $next)
    {
        return $next($this->apply($query));
    }

    abstract public function title(): string;

    abstract public function key(): string;

    abstract public function apply(Builder $query): Builder;

    abstract public function preparedValues(): mixed;

    abstract public function view(): string;

    public function requestValue(string $index = null, mixed $default = null): mixed
    {
        return request(
            'filters.' . $this->key() . ($index ? ".$index" : ""),
            $default
        );
    }

    public function name(string $index = null): string
    {
        return str($this->key())
            ->wrap('[', ']')
            ->prepend('filters')
            ->when($index, fn($str) => $str->append("[$index]"))
            ->value();
    }

    public function id(string $index = null): string
    {
        return str($this->name($index))
            ->slug('_')
            ->value();
    }

    public function initialValues(): array
    {
        return [];
    }

    public function badgeView(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.common.filters.badge', [
            'filter' => $this
        ]);
    }

    public function __toString(): string
    {
        return view($this->view(), [
            'filter' => $this
        ])->render();
    }
}