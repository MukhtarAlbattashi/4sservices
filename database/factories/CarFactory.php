<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner' => fake()->name(),
            'owner_id' => fake()->numerify('######'),
            'number' => fake()->numerify('############'),
            'letter' => fake()->text(5),
            'color' => fake()->colorName(),
            'year' => fake()->numerify('####'),
            'chassis' => fake()->numerify('############'),
            'cylinders' => fake()->numerify('#'),
            'attach' => fake()->name(),
            'other' => fake()->name(),
            'notes' => fake()->name(),
            'customer_id' => rand(1, 9),
            'car_brand_id' => rand(1, 10),
            'car_model_id' => rand(1, 10),
            'registration_type_id' => rand(1, 10),
            'user_id' => 1,
        ];
    }
}
