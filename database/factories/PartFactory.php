<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'arName' => fake()->colorName(),
            'enName' => fake()->colorName(),
            'sale_price' => rand(10,20),
            'purchase_price' => rand(1,9),
            'notes' => fake()->text(),
            'user_id' => 1,
        ];
    }
}
