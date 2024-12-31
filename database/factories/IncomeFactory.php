<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'income_him' => fake()->text(5),
            'amount' => fake()->numberBetween(1,10),
            'date' => fake()->dateTimeBetween('-30 years', now()->endOfYear()),
            'check' => fake()->text(5),
            'about' => fake()->text(5),
            'notes' => fake()->text(5),
            'income_category_id' => rand(1,20),
            'income_sub_category_id' => rand(1,20),
            'payment_id' => 1,
            'user_id' => 1,
        ];
    }
}
