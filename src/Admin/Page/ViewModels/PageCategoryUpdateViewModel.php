<?php

namespace Admin\Page\ViewModels;

use Domain\Page\Models\PageCategory;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class PageCategoryUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?PageCategory $pageCategory;

    public function __construct(PageCategory $pageCategory = null)
    {
        $this->pageCategory = $pageCategory;
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->pageCategory);
    }

    public function pageCategory(): ?PageCategory
    {
        return $this->pageCategory ?? null;
    }

    public function categories(): array
    {
        return PageCategory::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }
}
