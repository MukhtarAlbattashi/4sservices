<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainee>
 */
class TraineeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['male', 'female'];
        $attend = ['yes', 'no'];
        $nationality = ['Omani', 'US', "UK", 'KSA'];
        return [
            'traineeAr' => fake()->name(),
            'traineeEn' => fake('en_US')->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'idNumber' => fake()->numerify('##########'),
            'jobName' => fake()->jobTitle(),
            'gender' => Arr::random($gender),
            'nationality' => Arr::random($nationality),
            'religion' => fake()->text(),
            'status' => fake()->text(),
            'address' => fake()->address(),
            'academicQualification' => fake()->text(),
            'typeAcademic' => fake()->text(),
            'dateAcademic' => fake()->date(),
            'placeAcademic' => fake()->text(),
            'trainingDepartment' => fake()->text(),
            'trainingDuration' => fake()->text(),
            'trainingSalary' => fake()->text(),
            'startTrainingDate' => fake()->date(),
            'endTrainingDate' => fake()->date(),
            'trainingPlace' => fake()->text(),
            'attendTraining' => Arr::random($attend),
            'managementSkills' => fake()->text(),
            'technicalSkills' => fake()->text(),
            'evaluationTrainee' => fake()->text(),
            'notes' => fake()->text(),
        ];
    }
}
