<?php

namespace Domain\Page\ViewModels\Admin;

use Domain\Page\Models\Page;
use Spatie\ViewModels\ViewModel;

class PageUpdateViewModel extends ViewModel
{
    public ?Page $page;

    public function __construct(Page $page = null)
    {
        $this->page = $page;
    }

    public function page(): ?Page
    {
        return $this->page ?? null;
    }
}
