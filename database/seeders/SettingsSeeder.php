<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();
        $setting->fill([
            'companyNameAr' => 'لمحة للتجارة',
            'companyNameEn' => 'LAMHA FOR TRADING',
            'CRNo' => '1021863',
            'addressAr' => 'محافظة شمال الباطنة - الخابورة',
            'addressEn' => 'Al Batinah North Governorate - Al Khaboura',
            'governorateAr' => 'شمال الباطنة',
            'governorateEn' => 'Al Batinah North',
            'wilayatAr' => 'الخابورة',
            'wilayatEn' => 'Al Khaboura',
            'buildingNo' => '',
            'POBox' => '545',
            'pc' => '326',
            'email' => '',
            'phone' => '+968 96006500',
            'tax' => 5,
            'taxNumber' => '',
            'termsAr' => 'لا توجد',
            'termsEn' => 'لا توجد',
        ]);
        $setting->save();
    }
}
