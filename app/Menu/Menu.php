<?php

namespace App\Menu;

use Countable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use Support\Traits\Makeable;
use Traversable;

class Menu implements IteratorAggregate, Countable
{
    use Makeable;

    protected array $items = [];

    public function __construct(MenuGroup|MenuItem ...$items)
    {
        $this->items = $items;
    }

    public function all(): Collection
    {
        return Collection::make($this->items);
    }

    public function add(MenuItem|MenuGroup $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function addIf(bool|callable $condition, MenuItem $item): self
    {
        if (is_callable($condition) ? $condition() : $condition) {
            $this->items[] = $item;
        }

        return $this;
    }

    public function remove(MenuItem $item): self
    {
        $this->items = $this->all()
            ->filter(fn (MenuItem $current) => $item !== $current)
            ->toArray();

        return $this;
    }

    public function removeByLink(string $link): self
    {
        $this->items = $this->all()
            ->filter(fn (MenuItem $current) => $link !== $current->link())
            ->toArray();

        return $this;
    }

    public function getIterator(): Traversable
    {
        return $this->all();
    }

    public function count(): int
    {
        return count($this->items);
    }

    protected function recursiveCreateGroup(array $items, Menu|MenuGroup $menu): void
    {
        foreach ($items as $item) {
            $item['link'] = $item['link'] ?? '';
            $item['label'] = $item['label'] ?? '';
            $item['icon'] = $item['icon'] ?? '';
            $item['group'] = $item['group'] ?? '';
            $item['class'] = $item['class'] ?? '';

            if (is_array($item['group'])) {
                $group = MenuGroup::make()
                    ->setLabel($item['label'])
                    ->setLink($item['link'])
                    ->setIcon($item['icon'])
                    ->setClass($item['class']);
                $this->recursiveCreateGroup($item['group'], $group);

                $menu->add($group);
            } else {
                $menu->add(MenuItem::make($item['link'], $item['label'], $item['icon'], $item['class']));
            }
        }
    }

    public static function createFromArray(array $items): Menu
    {
        $menu = self::make();
        $menu->recursiveCreateGroup($items, $menu);
        return $menu;
    }
}
