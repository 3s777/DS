<?php

namespace Domain\Trade\Enums;

enum ShippingEnum: string
{
    case None = 'none';
    case World = 'world';
    case Selected = 'selected';
    case Country = 'country';

    public function name():string {
        return match($this) {
            ShippingEnum::None => __('collectible.shipping.none'),
            ShippingEnum::World => __('collectible.shipping.world'),
            ShippingEnum::Selected => __('collectible.shipping.selected'),
            ShippingEnum::Country => __('collectible.shipping.country'),
            default => __('collectible.shipping.country'),
        };
    }
}
