<?php

namespace Domain\Page\ViewModels\Admin;

use Domain\Page\Models\Page;
use Domain\Page\Models\PageCategory;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class PageUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?Page $page;

    public function __construct(Page $page = null)
    {
        $this->page = $page;
    }

    public function page(): ?Page
    {
        return $this->page ?? null;
    }

    public function categories(): array
    {
        return PageCategory::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->page);
    }

    public function selectedCategories(): ?array
    {

        return $this->page?->categories->pluck('id')->toArray() ?? null;
    }
}
