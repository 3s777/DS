<?php

namespace App\ViewModels\User;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class UserCreateViewModel extends ViewModel
{
    public function languages(): array
    {
        return Language::all()->select('id', 'name')->toArray();
    }
}
