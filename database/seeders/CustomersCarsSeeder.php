<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CustomersCarsSeeder extends Seeder
{
    public function run(): void
    {
        Car::factory()->count(10)->create();
    }
}
