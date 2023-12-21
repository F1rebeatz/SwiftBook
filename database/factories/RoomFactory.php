<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'description' => fake()->paragraph(),
            'poster_url' => fake()->imageUrl(200, 200, 'rooms'),
            'floor_area' => fake()->randomFloat(2, 20, 200),
            'type' => fake()->word,
            'price' => fake()->numberBetween(50, 500),
            'hotel_id' => function () {
                return Hotel::inRandomOrder()->first()->id;
            },
        ];
    }
}
