<?php

namespace Database\Factories;

use Domain\Game\Models\GamePublisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Game\Models\GamePublisher>
 */
class GamePublisherFactory extends Factory
{

    protected $model = GamePublisher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->title()
        ];
    }
}
