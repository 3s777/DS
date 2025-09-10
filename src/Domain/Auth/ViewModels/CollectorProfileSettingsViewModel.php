<?php

namespace Domain\Auth\ViewModels;

use Domain\Settings\Enums\LanguageEnum;
use Spatie\ViewModels\ViewModel;

class CollectorProfileSettingsViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function languages(): array
    {
        return LanguageEnum::cases();
    }
}
