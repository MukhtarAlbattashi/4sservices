<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'هندسة', 'ميكانيك', 'كهرباء', 'قطع غيار',
        ];
        $enItems = [
            'Engniring', 'Mechanical', 'Elctracity', 'Parts',
        ];

        for ($i = 0; $i <= 3; $i++) {
            $type = new ExpenseCategory();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->save();
        }

        $arItems = [
            'اصلاحات', 'أسلاك', 'مكائن', 'قطع استهلاكية',
        ];
        $enItems = [
            'Fixing', 'Wires', 'Motors', 'Consumers Parts',
        ];

        for ($i = 0; $i <= 3; $i++) {
            $type = new ExpenseSubCategory();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->expense_category_id = rand(1, 3);
            $type->save();
        }
    }
}
