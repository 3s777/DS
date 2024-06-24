<?php

namespace App\Menu;

use Support\Traits\Makeable;

class MenuItem
{
    use Makeable;

    protected const TYPE = 'link';

    public function __construct(
        protected string $link,
        protected string $label,
    ) {
    }

    public function link(): string
    {
        return $this->link;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function type(): string
    {
        return self::TYPE;
    }

    public function isActive(): bool
    {
        $path = parse_url($this->link(), PHP_URL_PATH) ?? '/';

        if(request()->path() === '/') {
            foreach (config('app.available_locales') as $locale) {
                if($path === '/'.$locale) {
                    return true;
                }
            }
        }

        return  request()->fullUrlIs($this->link . '?*', $this->link);
    }
}
