<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'تويوتا', 'جيب', 'فورد', 'شيفروليه', 'هوندا', 'نيسان',
            'بي إم دبليو', 'مرسيدس بنز', 'أودي', 'فولكس واجن', 'سوبارو',
            'هيونداي', 'كيا', 'فولفو', 'لكزس', 'بورش', 'تسلا', 'مازدا',
            'كاديلاك', 'بيوك','####'
        ];
        $enItems = [
            'toyota', 'jeep', 'ford', 'chevrolet', 'honda', 'nissan',
            'bmw', 'mercedes-benz', 'audi', 'volkswagen', 'subaru',
            'hyundai', 'kia', 'volvo', 'lexus', 'porsche', 'tesla',
            'mazda', 'cadillac', 'buick','####'
        ];

        for ($i = 0; $i <= 20; $i++) {
            $type = new CarBrand();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->user_id = 1;
            $type->save();
        }
    }
}
