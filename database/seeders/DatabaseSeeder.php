<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\User;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Income;
use App\Models\IncomeSubCategory;
use App\Models\RegistrationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleAndPermissionSeeder::class,
            TypeSeeder::class,
            BrandSeeder::class,
            SettingsSeeder::class,
            CarSeeder::class,
            PaymentSeeder::class,
            JopStatusSeeder::class,
            ServicesSeeder::class,
        ]);
        if(app()->environment('local')){
            $this->call([
                CustomersSeeder::class,
                ExpensesSeeder::class,
                PartsSeeder::class,
                CustomersCarsSeeder::class,
                SupplierSeeder::class,
                TraineeSeeder::class,
                EmployeeCategorySeeder::class,
                EmployeeSeeder::class,
                ContractSeeder::class,
                IncomeCategorySeeder::class,
                IncomeSubCategorySeeder::class,
                IncomeSeeder::class,
            ]);
        }
        $user = User::where('email', 'super@super.com')->first();
        $user->assignRole('super-admin');
    }
}
