<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'show-users']);

        Permission::create(['name' => 'create-allowances']);
        Permission::create(['name' => 'edit-allowances']);
        Permission::create(['name' => 'delete-allowances']);
        Permission::create(['name' => 'show-allowances']);

        Permission::create(['name' => 'create-allowance-categories']);
        Permission::create(['name' => 'edit-allowance-categories']);
        Permission::create(['name' => 'delete-allowance-categories']);
        Permission::create(['name' => 'show-allowance-categories']);

        Permission::create(['name' => 'create-assets']);
        Permission::create(['name' => 'edit-assets']);
        Permission::create(['name' => 'delete-assets']);
        Permission::create(['name' => 'show-assets']);

        Permission::create(['name' => 'create-asset-categories']);
        Permission::create(['name' => 'edit-asset-categories']);
        Permission::create(['name' => 'delete-asset-categories']);
        Permission::create(['name' => 'show-asset-categories']);

        Permission::create(['name' => 'create-asset-subcategories']);
        Permission::create(['name' => 'edit-asset-subcategories']);
        Permission::create(['name' => 'delete-asset-subcategories']);
        Permission::create(['name' => 'show-asset-subcategories']);

        Permission::create(['name' => 'create-cars']);
        Permission::create(['name' => 'edit-cars']);
        Permission::create(['name' => 'delete-cars']);
        Permission::create(['name' => 'show-cars']);

        Permission::create(['name' => 'create-car-brands']);
        Permission::create(['name' => 'edit-car-brands']);
        Permission::create(['name' => 'delete-car-brands']);
        Permission::create(['name' => 'show-car-brands']);

        Permission::create(['name' => 'create-car-models']);
        Permission::create(['name' => 'edit-car-models']);
        Permission::create(['name' => 'delete-car-models']);
        Permission::create(['name' => 'show-car-models']);

        Permission::create(['name' => 'create-contracts']);
        Permission::create(['name' => 'edit-contracts']);
        Permission::create(['name' => 'delete-contracts']);
        Permission::create(['name' => 'show-contracts']);

        Permission::create(['name' => 'create-courses']);
        Permission::create(['name' => 'edit-courses']);
        Permission::create(['name' => 'delete-courses']);
        Permission::create(['name' => 'show-courses']);

        Permission::create(['name' => 'create-customers']);
        Permission::create(['name' => 'edit-customers']);
        Permission::create(['name' => 'delete-customers']);
        Permission::create(['name' => 'show-customers']);

        Permission::create(['name' => 'create-discounts']);
        Permission::create(['name' => 'edit-discounts']);
        Permission::create(['name' => 'delete-discounts']);
        Permission::create(['name' => 'show-discounts']);

        Permission::create(['name' => 'create-discount-categories']);
        Permission::create(['name' => 'edit-discount-categories']);
        Permission::create(['name' => 'delete-discount-categories']);
        Permission::create(['name' => 'show-discount-categories']);

        Permission::create(['name' => 'create-employees']);
        Permission::create(['name' => 'edit-employees']);
        Permission::create(['name' => 'delete-employees']);
        Permission::create(['name' => 'show-employees']);

        Permission::create(['name' => 'create-employee-categories']);
        Permission::create(['name' => 'edit-employee-categories']);
        Permission::create(['name' => 'delete-employee-categories']);
        Permission::create(['name' => 'show-employee-categories']);

        Permission::create(['name' => 'create-expenses']);
        Permission::create(['name' => 'edit-expenses']);
        Permission::create(['name' => 'delete-expenses']);
        Permission::create(['name' => 'show-expenses']);

        Permission::create(['name' => 'create-expense-categories']);
        Permission::create(['name' => 'edit-expense-categories']);
        Permission::create(['name' => 'delete-expense-categories']);
        Permission::create(['name' => 'show-expense-categories']);

        Permission::create(['name' => 'create-expense-subcategories']);
        Permission::create(['name' => 'edit-expense-subcategories']);
        Permission::create(['name' => 'delete-expense-subcategories']);
        Permission::create(['name' => 'show-expense-subcategories']);

        Permission::create(['name' => 'create-holidays']);
        Permission::create(['name' => 'edit-holidays']);
        Permission::create(['name' => 'delete-holidays']);
        Permission::create(['name' => 'show-holidays']);

        Permission::create(['name' => 'create-holiday-categories']);
        Permission::create(['name' => 'edit-holiday-categories']);
        Permission::create(['name' => 'delete-holiday-categories']);
        Permission::create(['name' => 'show-holiday-categories']);

        Permission::create(['name' => 'create-incomes']);
        Permission::create(['name' => 'edit-incomes']);
        Permission::create(['name' => 'delete-incomes']);
        Permission::create(['name' => 'show-incomes']);

        Permission::create(['name' => 'create-income-categories']);
        Permission::create(['name' => 'edit-income-categories']);
        Permission::create(['name' => 'delete-income-categories']);
        Permission::create(['name' => 'show-income-categories']);

        Permission::create(['name' => 'create-income-subcategories']);
        Permission::create(['name' => 'edit-income-subcategories']);
        Permission::create(['name' => 'delete-income-subcategories']);
        Permission::create(['name' => 'show-income-subcategories']);

        Permission::create(['name' => 'create-invoices']);
        Permission::create(['name' => 'edit-invoices']);
        Permission::create(['name' => 'delete-invoices']);
        Permission::create(['name' => 'show-invoices']);

        Permission::create(['name' => 'create-invoice-payments']);
        Permission::create(['name' => 'edit-invoice-payments']);
        Permission::create(['name' => 'delete-invoice-payments']);
        Permission::create(['name' => 'show-invoice-payments']);

        Permission::create(['name' => 'create-job-cards']);
        Permission::create(['name' => 'edit-job-cards']);
        Permission::create(['name' => 'delete-job-cards']);
        Permission::create(['name' => 'show-job-cards']);

        Permission::create(['name' => 'create-job-statuses']);
        Permission::create(['name' => 'edit-job-statuses']);
        Permission::create(['name' => 'delete-job-statuses']);
        Permission::create(['name' => 'show-job-statuses']);

        Permission::create(['name' => 'create-parts']);
        Permission::create(['name' => 'edit-parts']);
        Permission::create(['name' => 'delete-parts']);
        Permission::create(['name' => 'show-parts']);

        Permission::create(['name' => 'create-payments']);
        Permission::create(['name' => 'edit-payments']);
        Permission::create(['name' => 'delete-payments']);
        Permission::create(['name' => 'show-payments']);

        Permission::create(['name' => 'create-purchases']);
        Permission::create(['name' => 'edit-purchases']);
        Permission::create(['name' => 'delete-purchases']);
        Permission::create(['name' => 'show-purchases']);

        Permission::create(['name' => 'create-purchase-payments']);
        Permission::create(['name' => 'edit-purchase-payments']);
        Permission::create(['name' => 'delete-purchase-payments']);
        Permission::create(['name' => 'show-purchase-payments']);

        Permission::create(['name' => 'create-quotations']);
        Permission::create(['name' => 'edit-quotations']);
        Permission::create(['name' => 'delete-quotations']);
        Permission::create(['name' => 'show-quotations']);

        Permission::create(['name' => 'create-registration-types']);
        Permission::create(['name' => 'edit-registration-types']);
        Permission::create(['name' => 'delete-registration-types']);
        Permission::create(['name' => 'show-registration-types']);

        Permission::create(['name' => 'create-roles']);
        Permission::create(['name' => 'edit-roles']);
        Permission::create(['name' => 'delete-roles']);
        Permission::create(['name' => 'show-roles']);

        Permission::create(['name' => 'create-salaries']);
        Permission::create(['name' => 'edit-salaries']);
        Permission::create(['name' => 'delete-salaries']);
        Permission::create(['name' => 'show-salaries']);

        Permission::create(['name' => 'create-services']);
        Permission::create(['name' => 'edit-services']);
        Permission::create(['name' => 'delete-services']);
        Permission::create(['name' => 'show-services']);

        Permission::create(['name' => 'create-settings']);
        Permission::create(['name' => 'edit-settings']);
        Permission::create(['name' => 'delete-settings']);
        Permission::create(['name' => 'show-settings']);

        Permission::create(['name' => 'create-suppliers']);
        Permission::create(['name' => 'edit-suppliers']);
        Permission::create(['name' => 'delete-suppliers']);
        Permission::create(['name' => 'show-suppliers']);

        Permission::create(['name' => 'create-trainees']);
        Permission::create(['name' => 'edit-trainees']);
        Permission::create(['name' => 'delete-trainees']);
        Permission::create(['name' => 'show-trainees']);

        Permission::create(['name' => 'create-loans']);
        Permission::create(['name' => 'edit-loans']);
        Permission::create(['name' => 'delete-loans']);
        Permission::create(['name' => 'show-loans']);

        Permission::create(['name' => 'show_customers_report']);
        Permission::create(['name' => 'show_cars_report']);
        Permission::create(['name' => 'show_invoices_report']);
        Permission::create(['name' => 'show_expenses_report']);
        Permission::create(['name' => 'show_incomes_report']);
        Permission::create(['name' => 'show_purchases_report']);
        Permission::create(['name' => 'show_summary_report']);


        Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);

        $adminRole->givePermissionTo([
            'create-customers',
            'edit-customers',
            'delete-customers',
            'show-customers',
        ]);
    }
}
