<?php

namespace Domain\Page\ViewModels\Admin;

use Domain\Page\Models\Page;
use Spatie\ViewModels\ViewModel;

class PageIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function pages()
    {
        return Page::query()
            ->select('pages.id', 'pages.name', 'pages.slug', 'pages.created_at', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'pages.user_id')
            ->orderBy('id', 'DESC')
            ->paginate(200)
            ->withQueryString();
    }
}
