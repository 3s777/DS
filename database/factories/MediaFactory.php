<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Auth\Models\User>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model_type' => 'Domain\Auth\Models\User',
            'model_id' => rand(1, 11),
            'collection_name' => rand(1, 5),
            'name' => fake()->name,
            'file_name' => fake()->name,
            'mime_type' => 'image/jpeg',
            'disk' => 'public',
            'conversions_disk' => 'public',
            'size' => rand(1, 1000000),
            'user_id' => rand(1, 11),
            'created_at' => now(),
            'manipulations' =>  [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => rand(1, 10000000)
        ];
    }
}
