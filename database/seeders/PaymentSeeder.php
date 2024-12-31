<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arItems = [
            'فيزا', 'كاش', 'شيك','هاتف',
        ];
        $enItems = [
            'Visa', 'Cash', 'Check','Phone',
        ];

        for ($i = 0; $i <= 3; $i++) {
            $type = new Payment();
            $type->arName = $arItems[$i];
            $type->enName = $enItems[$i];
            $type->save();
        }
    }
}
