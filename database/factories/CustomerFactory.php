<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = now();
        return [
            'name' => fake()->name(),
            'phone' => fake()->unique()->phoneNumber(),
            'tax_no' => Str::random(8),
            'address' => fake()->text(8),
            'identity' => fake()->unique()->phoneNumber(),
            'nationality' => fake()->text(5),
            'email' => fake()->unique()->email(),
            'note' => fake()->text(40),
            'created_at' => now()->timestamp,
        ];
    }
}
