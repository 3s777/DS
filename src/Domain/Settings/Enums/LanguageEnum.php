<?php

namespace Domain\Settings\Enums;

enum LanguageEnum: string
{
    case RU = 'ru';
    case UA = 'ua';
    case EN = 'en';

    public function name(): string
    {
        return match($this) {
            LanguageEnum::RU => __('common.languages.ru'),
            LanguageEnum::UA => __('common.languages.ua'),
            default => __('common.languages.en'),
        };
    }
}
