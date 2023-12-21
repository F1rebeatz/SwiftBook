<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FacilityRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => function () {
                return Facility::inRandomOrder()->firstOrCreate()->id;
            },
            'room_id' => function () {
                return Room::inRandomOrder()->firstOrCreate()->id;
            },
        ];
    }
}
