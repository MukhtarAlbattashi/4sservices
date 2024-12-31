<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contractName' => fake()->text(15),
            'jobNameAr' => fake()->text(10),
            'jobNameEn' => fake('en_US')->text(10),
            'contractDuration' => 'سنتين - Two Years',
            'startDateContract' => fake()->date(),
            'endDateContract' => fake()->date(),
            'dateContract' => fake()->date(),
            'basicSalary' => fake()->numberBetween(200, 800),
            'costOfLivingAllowance' => fake()->numberBetween(10, 100),
            'foodAllowance' => fake()->numberBetween(10, 100),
            'transferAllowance' => fake()->numberBetween(10, 100),
            'overtime' => fake()->numberBetween(10, 100),
            'housingAllowance' => fake()->numberBetween(10, 100),
            'phoneAllowance' => fake()->numberBetween(10, 100),
            'otherAllowance' => fake()->numberBetween(10, 100),
            'medical' => fake()->numberBetween(10, 100),
            'socialInsuranceDiscount' => fake()->numberBetween(10, 100),
            'totalSalary' => fake()->numberBetween(10, 100),
            'contractTermsAr' => fake()->text(),
            'contractTermsEn' => fake()->text(),
            'notes' => fake()->text(),
            'employee_id' => rand(1, 49),
        ];
    }
}
