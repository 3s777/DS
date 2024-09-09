<?php

namespace App\Enums;

enum ConditionEnum: string
{
    case New = 'new';
    case Used = 'used';
    case Refurbished = 'refurbished';
    case Repackaged = 'repackaged';

    case Other = 'other';

    public function name():string {
        return match($this) {
            ConditionEnum::Used => __('common.used'),
            ConditionEnum::Refurbished => __('common.refurbished'),
            ConditionEnum::Repackaged => __('common.repackaged'),
            ConditionEnum::Other => __('common.other'),
            default => __('common.new'),
        };
    }
}
