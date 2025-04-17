<?php

namespace Tests\Traits;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait HasSorters
{
    abstract public function getUser(): User;
    abstract public function getModels(): Collection;
    public function checkSortOrder(string $sortName, ?string $field = null, mixed $attribute = null): void
    {
        $request = [
            'sort' => $sortName
        ];

//        $m = $this->getModels()->sortBy($field ?? $sortName);
//
//        $m2 = $this->getModels()->sortBy($field ?? $sortName)
//            ->flatMap(fn ($item) => [$item->{$attribute ?? $sortName}])
//            ->toArray();
//
//        foreach ($m as $s) {
//            dump($s->name);
//        }
//        dump('Разделяем _______________');
//        foreach ($m2 as $s) {
//            dump($s);
//        }

        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertSeeInOrder(
                $this->getModels()->sortBy($field ?? $sortName)
                    ->flatMap(fn ($item) => [$item->{$attribute ?? $sortName}])
                    ->toArray()
            );
    }

    public function checkEnumSortOrder(string $sortName, string $enum, ?string $field = null, mixed $attribute = null): void
    {
        $request = [
            'sort' => $sortName
        ];

        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertSeeInOrder(
                $this->getModels()->sortBy($field ?? $sortName)
                    ->flatMap(fn ($item) => [$enum::tryFrom($item->{$attribute ?? $sortName})?->name()])
                    ->toArray()
            );
    }
}
