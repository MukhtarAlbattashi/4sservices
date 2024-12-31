<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carBrandsModels = [
            [
                'brandId' => 1,
                'models' => [
                    ['arName' => 'كامري', 'enName' => 'Camry'],
                    ['arName' => 'كورولا', 'enName' => 'Corolla'],
                    ['arName' => 'أفالون', 'enName' => 'Avalon'],
                    ['arName' => 'هايلاندر', 'enName' => 'Highlander'],
                    ['arName' => 'تاكوما', 'enName' => 'Tacoma'],
                    ['arName' => 'راف ٤', 'enName' => 'RAV4'],
                    ['arName' => 'سيينا', 'enName' => 'Sienna'],
                    ['arName' => '٤رنر', 'enName' => '4Runner'],
                    ['arName' => 'ياريس', 'enName' => 'Yaris'],
                    ['arName' => 'تندرا', 'enName' => 'Tundra'],
                ],
            ],
            [
                'brandId' => 2,
                'models' => [
                    ['arName' => 'رانجلر', 'enName' => 'Wrangler'],
                    ['arName' => 'غراند شيروكي', 'enName' => 'Grand Cherokee'],
                    ['arName' => 'رينيجاد', 'enName' => 'Renegade'],
                    ['arName' => 'شيروكي', 'enName' => 'Cherokee'],
                    ['arName' => 'كومباس', 'enName' => 'Compass'],
                    ['arName' => 'غلاديتور', 'enName' => 'Gladiator'],
                    ['arName' => 'باتريوت', 'enName' => 'Patriot'],
                    ['arName' => 'كوماندر', 'enName' => 'Commander'],
                    ['arName' => 'ليبرتي', 'enName' => 'Liberty'],
                ],
            ],
            [
                'brandId' => 3,
                'models' => [
                    ['arName' => 'F-150', 'enName' => 'F-150'],
                    ['arName' => 'موستانج', 'enName' => 'Mustang'],
                    ['arName' => 'إكسبلورر', 'enName' => 'Explorer'],
                    ['arName' => 'فيوجن', 'enName' => 'Fusion'],
                    ['arName' => 'إسكيب', 'enName' => 'Escape'],
                    ['arName' => 'رينجر', 'enName' => 'Ranger'],
                    ['arName' => 'إيدج', 'enName' => 'Edge'],
                    ['arName' => 'إكسبديشن', 'enName' => 'Expedition'],
                    ['arName' => 'فوكس', 'enName' => 'Focus'],
                    ['arName' => 'برونكو', 'enName' => 'Bronco'],
                ],
            ],
            [
                'brandId' => 4,
                'models' => [
                    ['arName' => 'ايمبالا', 'enName' => 'Impala'],
                    ['arName' => 'ماليبو', 'enName' => 'Malibu'],
                    ['arName' => 'كامارو', 'enName' => 'Camaro'],
                    ['arName' => 'كروز', 'enName' => 'Cruze'],
                    ['arName' => 'تاهو', 'enName' => 'Tahoe'],
                    ['arName' => 'سيلفرادو', 'enName' => 'Silverado'],
                    ['arName' => 'اكوينوكس', 'enName' => 'Equinox'],
                    ['arName' => 'ترافيرس', 'enName' => 'Traverse'],
                    ['arName' => 'سوبربان', 'enName' => 'Suburban'],
                    ['arName' => 'كولورادو', 'enName' => 'Colorado'],
                ],
            ],
            [
                'brandId' => 5,
                'models' => [
                    ['arName' => 'أكورد', 'enName' => 'Accord'],
                    ['arName' => 'سيفيك', 'enName' => 'Civic'],
                    ['arName' => 'CR-V', 'enName' => 'CR-V'],
                    ['arName' => 'بايلوت', 'enName' => 'Pilot'],
                    ['arName' => 'أوديسي', 'enName' => 'Odyssey'],
                    ['arName' => 'ريدجلاين', 'enName' => 'Ridgeline'],
                    ['arName' => 'HR-V', 'enName' => 'HR-V'],
                    ['arName' => 'فيت', 'enName' => 'Fit'],
                    ['arName' => 'إنسايت', 'enName' => 'Insight'],
                    ['arName' => 'باسبورت', 'enName' => 'Passport'],
                ],
            ],
            [
                'brandId' => 6,
                'models' => [
                    ['arName' => 'ألتيما', 'enName' => 'Altima'],
                    ['arName' => 'ماكسيما', 'enName' => 'Maxima'],
                    ['arName' => 'روغ', 'enName' => 'Rogue'],
                    ['arName' => 'سنترا', 'enName' => 'Sentra'],
                    ['arName' => 'مورانو', 'enName' => 'Murano'],
                    ['arName' => 'باثفايندر', 'enName' => 'Pathfinder'],
                    ['arName' => 'تيتان', 'enName' => 'Titan'],
                    ['arName' => 'جوك', 'enName' => 'Juke'],
                    ['arName' => 'أرمادا', 'enName' => 'Armada'],
                    ['arName' => 'زد', 'enName' => 'Z'],
                ],
            ],
            [
                'brandId' => 7,
                'models' => [
                    ['arName' => '3 Series', 'enName' => '3 Series'],
                    ['arName' => '5 Series', 'enName' => '5 Series'],
                    ['arName' => '7 Series', 'enName' => '7 Series'],
                    ['arName' => 'X3', 'enName' => 'X3'],
                    ['arName' => 'X5', 'enName' => 'X5'],
                    ['arName' => 'X7', 'enName' => 'X7'],
                    ['arName' => 'X1', 'enName' => 'X1'],
                    ['arName' => '4 Series', 'enName' => '4 Series'],
                    ['arName' => 'X6', 'enName' => 'X6'],
                    ['arName' => '8 Series', 'enName' => '8 Series'],
                ],
            ],
            [
                'brandId' => 8,
                'models' => [
                    ['arName' => 'A-Class', 'enName' => 'A-Class'],
                    ['arName' => 'C-Class', 'enName' => 'C-Class'],
                    ['arName' => 'E-Class', 'enName' => 'E-Class'],
                    ['arName' => 'S-Class', 'enName' => 'S-Class'],
                    ['arName' => 'GLA', 'enName' => 'GLA'],
                    ['arName' => 'GLE', 'enName' => 'GLE'],
                    ['arName' => 'GLC', 'enName' => 'GLC'],
                    ['arName' => 'GLS', 'enName' => 'GLS'],
                    ['arName' => 'CLA', 'enName' => 'CLA'],
                    ['arName' => 'CLS', 'enName' => 'CLS'],
                ],
            ],
            [
                'brandId' => 9,
                'models' => [
                    ['arName' => 'A3', 'enName' => 'A3'],
                    ['arName' => 'A4', 'enName' => 'A4'],
                    ['arName' => 'A6', 'enName' => 'A6'],
                    ['arName' => 'A8', 'enName' => 'A8'],
                    ['arName' => 'Q3', 'enName' => 'Q3'],
                    ['arName' => 'Q5', 'enName' => 'Q5'],
                    ['arName' => 'Q7', 'enName' => 'Q7'],
                    ['arName' => 'Q8', 'enName' => 'Q8'],
                    ['arName' => 'R8', 'enName' => 'R8'],
                    ['arName' => 'TT', 'enName' => 'TT'],
                ],
            ],
            [
                'brandId' => 10,
                'models' => [
                    ['arName' => 'جولف', 'enName' => 'Golf'],
                    ['arName' => 'باسات', 'enName' => 'Passat'],
                    ['arName' => 'بولو', 'enName' => 'Polo'],
                    ['arName' => 'جيتا', 'enName' => 'Jetta'],
                    ['arName' => 'تيغوان', 'enName' => 'Tiguan'],
                    ['arName' => 'أرتيون', 'enName' => 'Arteon'],
                    ['arName' => 'طوارق', 'enName' => 'Touareg'],
                    ['arName' => 'أطلس', 'enName' => 'Atlas'],
                    ['arName' => 'بيتل', 'enName' => 'Beetle'],
                    ['arName' => 'كارافيل', 'enName' => 'Caravelle'],
                ],
            ],
            [
                'brandId' => 11,
                'models' => [
                    ['arName' => 'أوتباك', 'enName' => 'Outback'],
                    ['arName' => 'إمبريزا', 'enName' => 'Impreza'],
                    ['arName' => 'فورستر', 'enName' => 'Forester'],
                    ['arName' => 'ليجاسي', 'enName' => 'Legacy'],
                    ['arName' => 'أسينت', 'enName' => 'Ascent'],
                    ['arName' => 'كروس تريك', 'enName' => 'Crosstrek'],
                    ['arName' => 'BRZ', 'enName' => 'BRZ'],
                    ['arName' => 'WRX', 'enName' => 'WRX'],
                ],
            ],
            [
                'brandId' => 12,
                'models' => [
                    ['arName' => 'إلنترا', 'enName' => 'Elantra'],
                    ['arName' => 'سوناتا', 'enName' => 'Sonata'],
                    ['arName' => 'توكسون', 'enName' => 'Tucson'],
                    ['arName' => 'سانتا في', 'enName' => 'Santa Fe'],
                    ['arName' => 'أكسنت', 'enName' => 'Accent'],
                    ['arName' => 'كريتا', 'enName' => 'Creta'],
                    ['arName' => 'أيونيك', 'enName' => 'Ioniq'],
                    ['arName' => 'فيلوستر', 'enName' => 'Veloster'],
                    ['arName' => 'كونا', 'enName' => 'Kona'],
                    ['arName' => 'باليساد', 'enName' => 'Palisade'],
                ],
            ],
            [
                'brandId' => 13,
                'models' => [
                    ['arName' => 'سورينتو', 'enName' => 'Sorento'],
                    ['arName' => 'سبورتاج', 'enName' => 'Sportage'],
                    ['arName' => 'أوبتيما', 'enName' => 'Optima'],
                    ['arName' => 'سول', 'enName' => 'Soul'],
                    ['arName' => 'ريو', 'enName' => 'Rio'],
                    ['arName' => 'كادينزا', 'enName' => 'Cadenza'],
                    ['arName' => 'فورت', 'enName' => 'Forte'],
                    ['arName' => 'سيدونا', 'enName' => 'Sedona'],
                    ['arName' => 'تيلورايد', 'enName' => 'Telluride'],
                    ['arName' => 'كارنز', 'enName' => 'Carnival'],
                ],
            ],
            [
                'brandId' => 14,
                'models' => [
                    ['arName' => 'XC90', 'enName' => 'XC90'],
                    ['arName' => 'XC60', 'enName' => 'XC60'],
                    ['arName' => 'XC40', 'enName' => 'XC40'],
                    ['arName' => 'S90', 'enName' => 'S90'],
                    ['arName' => 'S60', 'enName' => 'S60'],
                    ['arName' => 'V90', 'enName' => 'V90'],
                    ['arName' => 'V60', 'enName' => 'V60'],
                ],
            ],
            [
                'brandId' => 15,
                'models' => [
                    ['arName' => 'LS', 'enName' => 'LS'],
                    ['arName' => 'ES', 'enName' => 'ES'],
                    ['arName' => 'GS', 'enName' => 'GS'],
                    ['arName' => 'RX', 'enName' => 'RX'],
                    ['arName' => 'GX', 'enName' => 'GX'],
                    ['arName' => 'LX', 'enName' => 'LX'],
                    ['arName' => 'NX', 'enName' => 'NX'],
                    ['arName' => 'UX', 'enName' => 'UX'],
                    ['arName' => 'RC', 'enName' => 'RC'],
                    ['arName' => 'IS', 'enName' => 'IS'],
                ],
            ],
            [
                'brandId' => 16,
                'models' => [
                    ['arName' => '911', 'enName' => '911'],
                    ['arName' => '718', 'enName' => '718'],
                    ['arName' => 'Panamera', 'enName' => 'Panamera'],
                    ['arName' => 'Macan', 'enName' => 'Macan'],
                    ['arName' => 'Cayenne', 'enName' => 'Cayenne'],
                    ['arName' => 'Taycan', 'enName' => 'Taycan'],
                ],
            ],
            [
                'brandId' => 17,
                'models' => [
                    ['arName' => 'Model S', 'enName' => 'Model S'],
                    ['arName' => 'Model 3', 'enName' => 'Model 3'],
                    ['arName' => 'Model X', 'enName' => 'Model X'],
                    ['arName' => 'Model Y', 'enName' => 'Model Y'],
                    ['arName' => 'سايبرتراك', 'enName' => 'Cybertruck'],
                    ['arName' => 'رودستر', 'enName' => 'Roadster'],
                ],
            ],
            [
                'brandId' => 18,
                'models' => [
                    ['arName' => 'مازدا 3', 'enName' => 'Mazda3'],
                    ['arName' => 'مازدا 6', 'enName' => 'Mazda6'],
                    ['arName' => 'سي اكس 3', 'enName' => 'CX-3'],
                    ['arName' => 'سي اكس 5', 'enName' => 'CX-5'],
                    ['arName' => 'سي اكس 9', 'enName' => 'CX-9'],
                    ['arName' => 'مازدا 2', 'enName' => 'Mazda2'],
                    ['arName' => 'مازدا MX-5', 'enName' => 'Mazda MX-5'],
                    ['arName' => 'مازدا CX-30', 'enName' => 'Mazda CX-30'],
                    ['arName' => 'مازدا CX-50', 'enName' => 'Mazda CX-50'],
                    ['arName' => 'مازدا CX-90', 'enName' => 'Mazda CX-90'],
                ],
            ],
            [
                'brandId' => 19,
                'models' => [
                    ['arName' => 'CTS', 'enName' => 'CTS'],
                    ['arName' => 'CT5', 'enName' => 'CT5'],
                    ['arName' => 'XT4', 'enName' => 'XT4'],
                    ['arName' => 'XT5', 'enName' => 'XT5'],
                    ['arName' => 'XT6', 'enName' => 'XT6'],
                    ['arName' => 'Escalade', 'enName' => 'Escalade'],
                ],
            ],
            [
                'brandId' => 20,
                'models' => [
                    ['arName' => 'إنكور', 'enName' => 'Encore'],
                    ['arName' => 'إنكور جي اكس', 'enName' => 'Encore GX'],
                    ['arName' => 'إنكليف', 'enName' => 'Enclave'],
                    ['arName' => 'لوسيرن', 'enName' => 'Lucerne'],
                    ['arName' => 'رينديزفوز', 'enName' => 'Rendezvous'],
                    ['arName' => 'فيرانو', 'enName' => 'Verano'],
                ],
            ],
            [
                'brandId' => 21,
                'models' => [
                    ['arName' => '####', 'enName' => '####'],
                ],
            ],

        ];
        foreach ($carBrandsModels as $brandModels) {
            foreach ($brandModels['models'] as $model) {
                DB::table('car_models')->insert([
                    'car_brand_id' => $brandModels['brandId'],
                    'arName' => $model['arName'],
                    'enName' => $model['enName'],
                    'created_at' => now()
                ]);
            }
        }
    }
}
