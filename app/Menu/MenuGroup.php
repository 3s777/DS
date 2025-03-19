<?php

namespace App\Menu;

use Support\Traits\Makeable;

class MenuGroup extends Menu
{
    use Makeable;

    protected const TYPE = 'group';

    protected string $label;
    protected ?string $link = null;
    protected ?string $icon = null;
    protected ?string $class = null;

    public function type(): string
    {
        return self::TYPE;
    }

    public function setLabel($title): MenuGroup
    {
        $this->label = $title;

        return $this;
    }

    public function setLink($link): MenuGroup
    {
        $this->link = $link;

        return $this;
    }

    public function setIcon($icon): MenuGroup
    {
        $this->icon = $icon;

        return $this;
    }

    public function setClass($class): MenuGroup
    {
        $this->class = $class;

        return $this;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function link(): string
    {
        return $this->link;
    }

    public function icon(): string
    {
        return $this->icon;
    }

    public function class(): string
    {
        return $this->class;
    }


    public function isActive(): bool
    {
        return $this->recursiveCheckIsActive($this->all());
    }

    protected function recursiveCheckIsActive($item): bool
    {
        foreach ($item->all() as $item) {

            if ($item->type() === 'link') {
                $path = parse_url($item->link(), PHP_URL_PATH) ?? '/';

                if (request()->path() === '/') {
                    foreach (config('app.available_locales') as $locale) {
                        if ($path === '/'.$locale) {
                            return true;
                        }
                    }
                }

                if (request()->fullUrlIs($item->link() . '?*', $item->link())) {
                    return true;
                }
            } else {
                if ($this->recursiveCheckIsActive($item)) {
                    return true;
                }
            }
        }

        return false;
    }
}
