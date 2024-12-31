<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arName = [
            'صالون خارج عادي', 'صالون داخل وخارج عادي', 'صالون غسيل كامل',
            'متوسط وبيكاب خارج', 'متوسط وبيكاب داخل وخارج', 'متوسط وبيكاب غسيل كامل',
            'سيارة كبيرة خارج', 'سيارة كبيرة خارج وداخل', 'سيارة كبيرة غسيل كامل',
            'باص داخل وخارج', 'باص كامل', 'بيكاب دفع رباعي خارج وداخل', 'بيكاب دفع رباعي',
            'غسيل محرك بالماء فقط', 'غسيل بالماء فقط', 'هواء داخلي فقط', 'غسيل السجاد فقط',
            'تلميع الطبلون فقط', 'تلميع الاطارات فقط', 'دراجة بخارية',
            'فحص ميكانيكي نظري', 'فحص ما قبل الشراء', 'فحص زيت الدبل', 'فحص زيت الجير 8 غيار',
            'فحص السفايف الأربعة', 'فحص حرارة المحرك', 'فحص الدفريشنات', 'تغيير زيت الجير 6 غيار',
            'تغيير زيت الجير 8 غيار', 'تنظيف ثروتل وبرمجة', 'فحص كمبيوتر', 'برمجة الأعطال الجير',
            'برمجة الأعطال المحرك', 'برمجة الإطارات', 'برمجة سناسر الاكسجين', 'برمجة الكام شفت سنسر',
            'برمجة الكرنك سنسر', 'فحص الظفيرة كامل', 'تنظيف الايرثنج كامل', 'اصلاح خلل الظفيرة',
            'تنظيف مجمع الفيوزات', 'تغيير البطارية', 'تغيير سنسر الكرنك', 'تغيير سنسر جير8 غيار',
            'تغيير فيول بمب', 'تنظيف الكانستر', 'تغيير دينمو الشرش', 'تغيير دينمو السلف',
            'تغيير فاكيم بمب', 'تغيير كرسي الجير', 'تغيير زيت المحرك', 'تغيير زيت الفورويل',
            'تغيير سفايف امام', 'تغيير سفايف خلف', 'مخرطة درام ويل الواحد', 'فك وتركيب المحرك',
            'فك وتركيب الهيدات', 'فك وتركيب دفريشن امام', 'فك وتركيب دفريشن خلف',
            'فك وتركيب الجير', 'تغيير اويل بمب موديل قديم', 'تغيير اويل بمب موديل جديد',
            'تغيير الشلال فوق', 'تغيير الشلال تحت', 'تغيير هوب بيرنج', 'تغيير الجامبين خلف',
            'تغيير سفايف الهاند بريك', 'تغيير اويل دفريشن', 'فك وتركيب الرديتر',
            'فك وتركيب الواتر بمب', 'تغيير كولنت الرديتر', 'تغيير شمعات الاحتراق (البلكات)',
            'تغيير حزام المحرك والمكيف', 'فك وتركيب مبرد الجير', 'فك وتركيب كوندنسر المكيف',
            'فك وتركيب أجزاء المحرك كامل', 'كتابة تقرير', 'تقرير مفصل مع الصور', 'شرح أعطال المحرك'
        ];
        $enName = [
            'Small Car - Outside', 'Small Car - Outside/Inside', 'Small Car - Full Wash',
            'Medium Car & Pickup - Outside', 'Medium Car & Pickup - Outside/Inside', 'Medium Car & Pickup - Full Wash',
            'Big Car - Outside', 'Big Car - Outside/Inside', 'Big Car - Full Wash',
            'Bus - Outside/Inside', 'Bus - Full Wash', 'Pickup 4x4 - Outside/Inside', 'Pickup 4x4 - Full Wash',
            'Engine Wash', 'Water Wash Only', 'Inside Air Cleaning', 'Car Carfet Wash',
            'Dashboard Polish', 'Tyre Polish', 'Motor Bike',
            'Mechanical Theoretical Examination', 'Pre-Purchase Inspection', 'Double Oil Inspection',
            '8-Gear Transmission Oil Inspection', 'Four Brake Pads Inspection', 'Engine Temperature Inspection',
            'Differential Inspection', '6-Gear Transmission Oil Change', '8-Gear Transmission Oil Change',
            'Throttle Cleaning and Programming',
            'Computer Inspection', 'Transmission Fault Programming', 'Engine Fault Programming', 'Tire Programming',
            'Oxygen Sensor Programming', 'Camshaft Sensor Programming', 'Crankshaft Sensor Programming',
            'Complete Wiring Inspection', 'Complete Earthing Cleaning', 'Wiring Fault Repair', 'Fuse Box Cleaning',
            'Battery Replacement', 'Crankshaft Sensor Replacement', '8-Gear Transmission Sensor Replacement',
            'Fuel Pump Replacement', 'Canister Cleaning', 'Starter Dynamo Replacement', 'Self Dynamo Replacement',
            'Vacuum Pump Replacement', 'Transmission Mount Replacement', 'Engine Oil Change', 'Four-Wheel Oil Change',
            'Front Brake Pads Replacement', 'Rear Brake Pads Replacement', 'Single Drum Wheel Machining',
            'Engine Assembly and Disassembly', 'Cylinder Head Assembly and Disassembly',
            'Front Differential Assembly and Disassembly', 'Rear Differential Assembly and Disassembly',
            'Transmission Assembly and Disassembly', 'Old Model Oil Pump Replacement', 'New Model Oil Pump Replacement',
            'Upper Waterfall Replacement', 'Lower Waterfall Replacement', 'Hub Bearing Replacement',
            'Rear Shock Absorber Replacement', 'Handbrake Pads Replacement', 'Differential Oil Change',
            'Radiator Assembly and Disassembly', 'Water Pump Assembly and Disassembly', 'Radiator Coolant Change',
            'Combustion Plugs (Spark Plugs) Replacement', 'Engine and AC Belt Replacement',
            'Transmission Cooler Assembly and Disassembly', 'AC Condenser Assembly and Disassembly',
            'Complete Engine Parts Assembly and Disassembly', 'Report Writing', 'Detailed Report with Photos',
            'Engine Fault Explanation'
        ];
        $price = [
            1.5, 2, 3,
            2, 2.5, 3.5,
            2.5, 3, 4,
            2.5, 4, 3, 4,
            0.5, 0.5, 0.5, 0.5, 0.5, 0.5, 1,
            5, 20, 2, 2, 5, 5, 10, 15, 20, 10, 5, 35, 10, 5, 35, 30, 15, 35, 25, 60, 10, 5, 10, 25, 35, 45, 5, 10, 30,
            10, 2, 5, 4, 4, 2, 120, 80, 25, 50, 60, 90, 120, 5, 10, 10, 5, 3, 5, 10, 15, 5, 10, 5, 30, 20, 250, 15, 35,
            5
        ];
        for ($i = 0; $i <= 78; $i++) {
            $service = new Service();
            $service->arName = $arName[$i];
            $service->enName = $enName[$i];
            $service->amount = $price[$i];
            $service->save();
        }
    }
}
