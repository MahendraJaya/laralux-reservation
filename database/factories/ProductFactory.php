<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->words(1, true),
            "price" => fake()->randomNumber(5, true),
            "capacity" => random_int(1,6),
            "image" => "https://picsum.photos/200/300",
            "available_room" => random_int(1,14),
            "hotel_id" => random_int(1, 5),
            "type_product_id" => random_int(1,10)

        ];
    }
}
