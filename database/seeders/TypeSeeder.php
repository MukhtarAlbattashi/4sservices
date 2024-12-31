<?php

namespace Database\Seeders;

use App\Models\RegistrationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'خصوصي', 'نقل عام', 'نقل خاص', 'مقطورة', 'دراجة نارية',
            'مركبة أجرة', 'تصدير', 'دراجة نارية', 'هيئة دبلوماسية',
            'حافلة عامة', 'حافلة خاصة', 'مؤقتة', 'مركبة أشغال عامة','####'
        ];
        $enItems = [
            'private', 'public transport', 'private transport', 'trailer',
            'motorcycle', 'taxi', 'export', 'recreational motorcycle', 'diplomatic corps',
            'public bus', 'private bus', 'temporary', 'public works vehicles','####'
        ];

        for ($i = 0; $i <= 13; $i++) {
            $type = new RegistrationType();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->user_id = 1;
            $type->save();
        }
    }
}
