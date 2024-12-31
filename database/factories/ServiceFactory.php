<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceFactory extends Factory
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
            'amount' => fake()->numerify("##"),
            'notes' => fake()->text(),
            'user_id' => 1,
        ];
    }
}
