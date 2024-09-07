<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $item) {
            $item->makeSlug();
        });

        static::saving(function (Model $item) {
            $item->makeSlug();
        });
    }

    protected function makeSlug()
    {
        if(!$this->{$this->slugColumn()}) {
            $slug = $this->slugUnique(
                str($this->{$this->slugFrom()})
                    ->slug()
                    ->value()
            );
        } else {
            $slug = $this->slugUnique(
                $this->{$this->slugColumn()}
            );
        }

        $this->{$this->slugColumn()} = $slug;
    }

    protected function slugColumn(): string
    {
        return 'slug';
    }

    protected function slugFrom(): string
    {
        return 'name';
    }

    private function slugUnique(string $slug): string
    {
        $orginalSlug = $slug;
        $i = 0;

        while ($this->isSlugExists($slug)) {
            $i++;

            $slug = $orginalSlug.'-'.$i;
        }

        return $slug;
    }

    private function isSlugExists(string $slug): bool
    {
        $query = $this->newQuery()
            ->where(self::slugColumn(), $slug)
            ->where($this->getKeyName(), '!=', $this->getKey())
            ->withoutGlobalScopes();

        return $query->exists();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
