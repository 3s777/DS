<?php

namespace Domain\Game\ViewModels;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Domain\Game\Models\GamePlatformManufacturer;
use Spatie\ViewModels\ViewModel;

class GameDeveloperListSelectViewModel extends ViewModel
{
    public function __construct(protected null|string $query)
    {
    }

    public function result(): array
    {
        $result = [
            ['value' => '', 'label' => __('game_developer.choose')]
        ];

        if($this->query) {
            $developers = GameDeveloper::where('name', 'ilike', "%{$this->query}%")->select('id', 'name')->get();

            foreach ($developers as $developer) {
                $result[] = ['value' => $developer->id, 'label' => $developer->name];
            }

            if($developers->isEmpty()) {
                $result[] = ['value' => '', 'label' => __('common.not_found'), 'disabled' => true];
            }
        }

        return $result;
    }
}
