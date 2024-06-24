<?php

namespace App\Menu;

use Illuminate\Support\Collection;
use Support\Traits\Makeable;

class MenuGroup
{
    use Makeable;

    protected array $items = [];
    protected string $label;

    public function __construct(MenuItem ...$items)
    {
        $this->items = $items;
    }

    public function setLabel($title): MenuGroup
    {
        $this->label = $title;

        return $this;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function all(): Collection
    {
        return Collection::make($this->items);
    }

    public function add(MenuGroup|MenuItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    public function addIf(bool|callable $condition, MenuGroup|MenuItem $item): self
    {
        if(is_callable($condition) ? $condition() : $condition) {
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

    public function type(): string
    {
        return 'group';
    }

    public function isActive()
    {
//        foreach($this->all() as $item) {
//
//            if($item->type() !== 'link') {
//                continue;
//            }
//
//            $path = parse_url($item->link(), PHP_URL_PATH) ?? '/';
//
//            if(request()->path() === '/') {
//                foreach (config('app.available_locales') as $locale) {
//                    if($path === '/'.$locale) {
//                        return true;
//                    }
//                }
//            }
//
//            if(request()->fullUrlIs($item->link() . '?*', $item->link())) {
//                return true;
//            }
//        }


        return $this->recursiveCheckIsActive($this->all());
    }

    private function recursiveCheckIsActive($item) {
        foreach($item->all() as $item) {

            if($item->type() === 'link') {
                $path = parse_url($item->link(), PHP_URL_PATH) ?? '/';

                if(request()->path() === '/') {
                    foreach (config('app.available_locales') as $locale) {
                        if($path === '/'.$locale) {
                            return true;
                        }
                    }
                }

                if(request()->fullUrlIs($item->link() . '?*', $item->link())) {
                    return true;
                }
            } else {
                if($this->recursiveCheckIsActive($item)) {
                    return true;
                }
            }



//            if($item->type() !== 'link') {
//                if($this->recursiveCheckIsActive($item)) {
//                    return true;
//                }
//
//
//
//        } else {
//
//                $path = parse_url($item->link(), PHP_URL_PATH) ?? '/';
//
//                if(request()->path() === '/') {
//                    foreach (config('app.available_locales') as $locale) {
//                        if($path === '/'.$locale) {
//                            return true;
//                        }
//                    }
//                }
//
//                if(request()->fullUrlIs($item->link() . '?*', $item->link())) {
//                    return true;
//                }
//            }


        }


        return false;
    }
}
