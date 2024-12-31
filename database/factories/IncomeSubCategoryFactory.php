<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeSubCategory>
 */
class IncomeSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'arName' => fake()->text(5),
            'enName' => fake()->text(5),
            'income_category_id' => rand(1,20),
        ];
    }
}
