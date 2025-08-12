<?php

namespace Domain\Page\ViewModels\Admin;

use Domain\Page\Models\PageCategory;
use Spatie\ViewModels\ViewModel;

class PageCategoryIndexViewModel extends ViewModel
{
    public function pageCategories()
    {
        return PageCategory::query()
            ->select(
                'page_categories.id',
                'page_categories.name',
                'page_categories.slug',
                'page_categories.created_at',
                'page_categories.parent_id',
                'users.name as user_name',
                //                'parent.name->ru as parent_name',
            )
            ->leftJoin('users', 'users.id', '=', 'page_categories.user_id')
//            ->leftJoin('page_categories as parent', 'parent.id', '=', 'page_categories.parent_id')
            ->with(['parent'])
            ->orderBy('id', 'DESC')
            ->paginate(100)
            ->withQueryString();
    }
}
