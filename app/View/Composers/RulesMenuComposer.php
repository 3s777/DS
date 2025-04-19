<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use Domain\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

final class RulesMenuComposer
{
    public function compose(View $view): void
    {
        $menu = Menu::make();

        $menu->add(MenuItem::make(route('qa'), __('common.qa')));

        $rules = Page::whereHas('categories', function (Builder $query) {
                $query->where('slug', 'rules');
            })->get();
        foreach ($rules as $rule) {
            $menu->add(MenuItem::make(route('rules.show', ['page' => $rule->slug]), $rule->name));
        }

        $view->with('menu', $menu);
    }
}
