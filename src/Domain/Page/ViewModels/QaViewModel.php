<?php

namespace Domain\Page\ViewModels;

use Domain\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Spatie\ViewModels\ViewModel;

class QaViewModel extends ViewModel
{
    public function qas()
    {
        return Page::whereHas('categories', function (Builder $query) {
            $query->where('slug', 'qa');
        })->get();
    }
}
