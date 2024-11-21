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

    protected string $title;

    protected string $key;

    protected string $table;

    protected ?string $field;

    protected string|array|null $placeholder;

    abstract public function apply(Builder $query): Builder;

    abstract public function preparedValues(): mixed;

    abstract public function view(): string;

    public function __construct(
        string $title,
        string $key,
        string $table,
        ?string $field = null,
        string|array|null $placeholder = null
    )
    {
        $this->setTitle($title);
        $this->setKey($key);
        $this->setTable($table);
        $this->setField($field);
        $this->setPlaceholder($placeholder);
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function setKey(string $key): static
    {
        $this->key = $key;
        return $this;
    }

    public function setTable(string $table): static
    {
        $this->table = $table;
        return $this;
    }

    public function setField(?string $field): static
    {
        $this->field = 'id';

        if($field) {
            $this->field = $field;
        }

        return $this;
    }

    public function setPlaceholder(string|array|null $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function placeholder(string $key = ''): string|array|null
    {
        if($key && is_array($this->placeholder)) {
            return $this->placeholder[$key];
        }

        return $this->placeholder;
    }

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
            ->when($index, fn ($str) => $str->append("[$index]"))
            ->value();
    }

    public function id(string $index = null): string
    {
        return str($this->key())
            ->prepend('filters_')
            ->when($index, fn ($str) => $str->append("_$index"))
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
