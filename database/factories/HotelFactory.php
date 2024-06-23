<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->words(2, true),
            "address" => fake()->address(),
            "telephone" => fake()->phoneNumber(),
            "email" => fake()->unique()->safeEmail(),
            "city" => fake()->city(),
            "rating" => random_int(1, 5),
            "image" => "https://picsum.photos/200/300",
            "user_id" => random_int(1, 4),
            "type_hotel_id" => random_int(1, 10)
        ];
    }
}
