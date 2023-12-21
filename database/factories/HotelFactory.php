<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Hotel>
 */
class HotelFactory extends Factory
{
    protected $model = Hotel::class;
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'description' => fake()->paragraph(),
            'poster_url' => fake()->imageUrl(200, 200, 'hotels'),
            'address' => fake()->address(),
        ];
    }
}
