<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CounterButtons extends Component
{
    public function __construct(
        public string $type = 'standard',
        public ?string $buttonClass = null,
        public ?string $badgeClass = null,
        public ?int $collection = null,
        public ?int $sale = null,
        public ?int $auction = null,
        public ?int $wishlist = null,
        public ?int $exchange = null,
        public ?int $favorite = null,
        public string $collectionLink = '#',
        public string $saleLink = '#',
        public string $auctionLink = '#',
        public string $wishlistLink = '#',
        public string $exchangeLink = '#',
        public string $favoriteLink = '#',
    ) {
        if ($type == 'light') {
            $this->buttonClass = $buttonClass. ' counter-buttons__button_light';
            $this->badgeClass = $badgeClass. ' counter-buttons__badge_light';
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.common.counter-buttons');
    }
}
