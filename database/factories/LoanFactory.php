<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'from' => Carbon::now(),
            'to' => Carbon::now(),
            'amount' => $this->faker->randomFloat(),
            'active' => $this->faker->boolean(),
        ];
    }
}
