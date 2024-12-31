<?php

namespace Database\Seeders;

use App\Models\EmployeeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'القسم المالي', 'القسم الفني', 'القسم التقني', 'القسم الاعلامى',
        ];
        $enItems = [
            'Financing', 'Mechanical', 'Elctracity', 'Advertising',
        ];

        for ($i = 0; $i <= 3; $i++) {
            $type = new EmployeeCategory();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->save();
        }
    }
}
