<?php

namespace Domain\Game\ViewModels;

use Domain\Game\Models\GamePublisher;
use Spatie\ViewModels\ViewModel;

class GamePublisherListSelectViewModel extends ViewModel
{
    public function __construct(protected null|string $query)
    {
    }

    public function result(): array
    {
        $result = [
            ['value' => '', 'label' => __('game_publisher.choose')]
        ];

        if($this->query) {
            $publishers = GamePublisher::where('name', 'ilike', "%{$this->query}%")->select('id', 'name')->get();

            foreach ($publishers as $publisher) {
                $result[] = ['value' => $publisher->id, 'label' => $publisher->name];
            }

            if($publishers->isEmpty()) {
                $result[] = ['value' => '', 'label' => __('common.not_found'), 'disabled' => true];
            }
        }

        return $result;
    }
}
