<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['male', 'female'];
        $nationality = ['Omani', 'US', "UK", 'KSA'];
        return [
            'status' => rand(0,1),
            'employeeNumber' => fake()->numerify('#########'),
            'joinDate' => fake()->date(),
            'employeeNameAr' => fake()->name(),
            'employeeNameEn' => fake('en_US')->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'password' => fake()->password(),
            'jopNameAr' => fake()->text(10),
            'jopNameEn' => fake('en_US')->text(10),
            'birthDate' => fake()->date(),
            'gender' => Arr::random($gender),
            'nationality' => Arr::random($nationality),
            'religion' => fake()->text(10),
            'socialStatus' => fake()->text(10),
            'idNumber' => fake()->numerify('ID#########'),
            'dateOfIssue' => fake()->date(),
            'expiryDate' => fake()->date(),
            'passportNumber' => fake()->numerify('PS#########'),
            'passportDateOfIssue' => fake()->date(),
            'passportExpiryDate' => fake()->date(),
            'placeOfIssue' => fake()->address(),
            'academicQualification' => fake()->text(10),
            'typeAcademic' => fake()->text(10),
            'dateAcademic' => fake()->date(),
            'placeAcademic' => fake()->address(),
            'address' => fake()->address(),
            'notes' => fake()->text(),
            'employee_category_id' => Arr::random([1, 2, 3, 4]),
        ];
    }
}
