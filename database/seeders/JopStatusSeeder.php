<?php

namespace Database\Seeders;

use App\Models\JopStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JopStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'جديد', 'جار العمل', 'تم الانتهاء', 'متوقف',
        ];
        $enItems = [
            'New', 'In Progress', 'Done', 'Stop',
        ];
        $colors = [
            '#2ecc71', '#f1c40f', '#3498db', '#e74c3c',
        ];

        for ($i = 0; $i <= 3; $i++) {
            $type = new JopStatus();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->color = $colors[$i];
            $type->save();
        }

    }
}
