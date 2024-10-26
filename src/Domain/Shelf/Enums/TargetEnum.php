<?php

namespace Domain\Shelf\Enums;

enum TargetEnum: string
{
    case Collection = 'collection';
    case Sale = 'sale';
    case Auction = 'auction';
    case Exchange = 'exchange';

    public function name():string {
        return match($this) {
            TargetEnum::Sale => __('common.for_sale'),
            TargetEnum::Auction => __('common.for_auction'),
            TargetEnum::Exchange => __('common.for_exchange'),
            default => __('common.for_collection'),
        };
    }
}
