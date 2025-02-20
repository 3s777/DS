<?php

namespace Domain\Trade\Enums;

enum ReservationEnum: string
{
    case None = 'none';
    case Prepayment = 'prepayment';
    case Message = 'message';
    case Other = 'other';

    public function name():string {
        return match($this) {
            ReservationEnum::None => __('collectible.reservation.none'),
            ReservationEnum::Prepayment => __('collectible.reservation.prepayment'),
            ReservationEnum::Message => __('collectible.reservation.message'),
            ReservationEnum::Other=> __('collectible.reservation.other'),
            default => __('collectible.reservation.none'),
        };
    }
}
