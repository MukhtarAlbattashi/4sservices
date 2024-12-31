<?php

namespace Database\Seeders;

use App\Models\IncomeSubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncomeSubCategory::factory(20)->create();
    }
}
