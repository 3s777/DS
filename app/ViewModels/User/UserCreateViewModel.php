<?php

namespace App\ViewModels\User;

use App\Models\Language;
use Domain\Auth\Models\User;
use Spatie\ViewModels\ViewModel;

class UserCreateViewModel extends ViewModel
{
    public ?User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function languages(): array
    {
        return Language::all()->select('id', 'name')->toArray();
    }
}
