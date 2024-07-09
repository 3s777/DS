<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;
use Spatie\ViewModels\ViewModel;

class GamePlatformManufacturerListSelectViewModel extends ViewModel
{
    public function __construct(protected null|string $query)
    {
    }

    public function result(): array
    {
        $result = [
            ['value' => '', 'label' => __('game_platform_manufacturer.choose')]
        ];

        if($this->query) {
            $manufacturers = GamePlatformManufacturer::where('name', 'ilike', "%{$this->query}%")->select('id', 'name')->get();

            foreach ($manufacturers as $manufacturer) {
                $result[] = ['value' => $manufacturer->id, 'label' => $manufacturer->name];
            }

            if($manufacturers->isEmpty()) {
                $result[] = ['value' => '', 'label' => __('common.not_found'), 'disabled' => true];
            }
        }

        return $result;
    }
}
