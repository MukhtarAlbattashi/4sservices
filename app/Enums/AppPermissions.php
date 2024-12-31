<?php

namespace App\Enums;

class AppPermissions
{
    // User permissions
    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_EDIT_USERS = 'edit-users';
    public const CAN_DELETE_USERS = 'delete-users';
    public const CAN_SHOW_USERS = 'show-users';

    // Allowances permissions
    public const CAN_CREATE_ALLOWANCES = 'create-allowances';
    public const CAN_EDIT_ALLOWANCES = 'edit-allowances';
    public const CAN_DELETE_ALLOWANCES = 'delete-allowances';
    public const CAN_SHOW_ALLOWANCES = 'show-allowances';

    // Allowance categories permissions
    public const CAN_CREATE_ALLOWANCE_CATEGORIES = 'create-allowance-categories';
    public const CAN_EDIT_ALLOWANCE_CATEGORIES = 'edit-allowance-categories';
    public const CAN_DELETE_ALLOWANCE_CATEGORIES = 'delete-allowance-categories';
    public const CAN_SHOW_ALLOWANCE_CATEGORIES = 'show-allowance-categories';

    // Assets permissions
    public const CAN_CREATE_ASSETS = 'create-assets';
    public const CAN_EDIT_ASSETS = 'edit-assets';
    public const CAN_DELETE_ASSETS = 'delete-assets';
    public const CAN_SHOW_ASSETS = 'show-assets';

    // Asset categories permissions
    public const CAN_CREATE_ASSET_CATEGORIES = 'create-asset-categories';
    public const CAN_EDIT_ASSET_CATEGORIES = 'edit-asset-categories';
    public const CAN_DELETE_ASSET_CATEGORIES = 'delete-asset-categories';
    public const CAN_SHOW_ASSET_CATEGORIES = 'show-asset-categories';

    // Asset subcategories permissions
    public const CAN_CREATE_ASSET_SUBCATEGORIES = 'create-asset-subcategories';
    public const CAN_EDIT_ASSET_SUBCATEGORIES = 'edit-asset-subcategories';
    public const CAN_DELETE_ASSET_SUBCATEGORIES = 'delete-asset-subcategories';
    public const CAN_SHOW_ASSET_SUBCATEGORIES = 'show-asset-subcategories';

// Cars permissions
    public const CAN_CREATE_CARS = 'create-cars';
    public const CAN_EDIT_CARS = 'edit-cars';
    public const CAN_DELETE_CARS = 'delete-cars';
    public const CAN_SHOW_CARS = 'show-cars';

// Car brands permissions
    public const CAN_CREATE_CAR_BRANDS = 'create-car-brands';
    public const CAN_EDIT_CAR_BRANDS = 'edit-car-brands';
    public const CAN_DELETE_CAR_BRANDS = 'delete-car-brands';
    public const CAN_SHOW_CAR_BRANDS = 'show-car-brands';

// Car models permissions
    public const CAN_CREATE_CAR_MODELS = 'create-car-models';
    public const CAN_EDIT_CAR_MODELS = 'edit-car-models';
    public const CAN_DELETE_CAR_MODELS = 'delete-car-models';
    public const CAN_SHOW_CAR_MODELS = 'show-car-models';

// Contracts permissions
    public const CAN_CREATE_CONTRACTS = 'create-contracts';
    public const CAN_EDIT_CONTRACTS = 'edit-contracts';
    public const CAN_DELETE_CONTRACTS = 'delete-contracts';
    public const CAN_SHOW_CONTRACTS = 'show-contracts';

// Courses permissions
    public const CAN_CREATE_COURSES = 'create-courses';
    public const CAN_EDIT_COURSES = 'edit-courses';
    public const CAN_DELETE_COURSES = 'delete-courses';
    public const CAN_SHOW_COURSES = 'show-courses';

// Customers permissions
    public const CAN_CREATE_CUSTOMERS = 'create-customers';
    public const CAN_EDIT_CUSTOMERS = 'edit-customers';
    public const CAN_DELETE_CUSTOMERS = 'delete-customers';
    public const CAN_SHOW_CUSTOMERS = 'show-customers';

// Discounts permissions
    public const CAN_CREATE_DISCOUNTS = 'create-discounts';
    public const CAN_EDIT_DISCOUNTS = 'edit-discounts';
    public const CAN_DELETE_DISCOUNTS = 'delete-discounts';
    public const CAN_SHOW_DISCOUNTS = 'show-discounts';

// Discount categories permissions
    public const CAN_CREATE_DISCOUNT_CATEGORIES = 'create-discount-categories';
    public const CAN_EDIT_DISCOUNT_CATEGORIES = 'edit-discount-categories';
    public const CAN_DELETE_DISCOUNT_CATEGORIES = 'delete-discount-categories';
    public const CAN_SHOW_DISCOUNT_CATEGORIES = 'show-discount-categories';

// Employees permissions
    public const CAN_CREATE_EMPLOYEES = 'create-employees';
    public const CAN_EDIT_EMPLOYEES = 'edit-employees';
    public const CAN_DELETE_EMPLOYEES = 'delete-employees';
    public const CAN_SHOW_EMPLOYEES = 'show-employees';

// Employee categories permissions
    public const CAN_CREATE_EMPLOYEE_CATEGORIES = 'create-employee-categories';
    public const CAN_EDIT_EMPLOYEE_CATEGORIES = 'edit-employee-categories';
    public const CAN_DELETE_EMPLOYEE_CATEGORIES = 'delete-employee-categories';
    public const CAN_SHOW_EMPLOYEE_CATEGORIES = 'show-employee-categories';

// Expenses permissions
    public const CAN_CREATE_EXPENSES = 'create-expenses';
    public const CAN_EDIT_EXPENSES = 'edit-expenses';
    public const CAN_DELETE_EXPENSES = 'delete-expenses';
    public const CAN_SHOW_EXPENSES = 'show-expenses';

    // Expense categories permissions
    public const CAN_CREATE_EXPENSE_CATEGORIES = 'create-expense-categories';
    public const CAN_EDIT_EXPENSE_CATEGORIES = 'edit-expense-categories';
    public const CAN_DELETE_EXPENSE_CATEGORIES = 'delete-expense-categories';
    public const CAN_SHOW_EXPENSE_CATEGORIES = 'show-expense-categories';

// Expense subcategories permissions
    public const CAN_CREATE_EXPENSE_SUBCATEGORIES = 'create-expense-subcategories';
    public const CAN_EDIT_EXPENSE_SUBCATEGORIES = 'edit-expense-subcategories';
    public const CAN_DELETE_EXPENSE_SUBCATEGORIES = 'delete-expense-subcategories';
    public const CAN_SHOW_EXPENSE_SUBCATEGORIES = 'show-expense-subcategories';

// Holidays permissions
    public const CAN_CREATE_HOLIDAYS = 'create-holidays';
    public const CAN_EDIT_HOLIDAYS = 'edit-holidays';
    public const CAN_DELETE_HOLIDAYS = 'delete-holidays';
    public const CAN_SHOW_HOLIDAYS = 'show-holidays';

// Holiday categories permissions
    public const CAN_CREATE_HOLIDAY_CATEGORIES = 'create-holiday-categories';
    public const CAN_EDIT_HOLIDAY_CATEGORIES = 'edit-holiday-categories';
    public const CAN_DELETE_HOLIDAY_CATEGORIES = 'delete-holiday-categories';
    public const CAN_SHOW_HOLIDAY_CATEGORIES = 'show-holiday-categories';

// Incomes permissions
    public const CAN_CREATE_INCOMES = 'create-incomes';
    public const CAN_EDIT_INCOMES = 'edit-incomes';
    public const CAN_DELETE_INCOMES = 'delete-incomes';
    public const CAN_SHOW_INCOMES = 'show-incomes';

// Income categories permissions
    public const CAN_CREATE_INCOME_CATEGORIES = 'create-income-categories';
    public const CAN_EDIT_INCOME_CATEGORIES = 'edit-income-categories';
    public const CAN_DELETE_INCOME_CATEGORIES = 'delete-income-categories';
    public const CAN_SHOW_INCOME_CATEGORIES = 'show-income-categories';

    // Income subcategories permissions
    public const CAN_CREATE_INCOME_SUBCATEGORIES = 'create-income-subcategories';
    public const CAN_EDIT_INCOME_SUBCATEGORIES = 'edit-income-subcategories';
    public const CAN_DELETE_INCOME_SUBCATEGORIES = 'delete-income-subcategories';
    public const CAN_SHOW_INCOME_SUBCATEGORIES = 'show-income-subcategories';

// Invoices permissions
    public const CAN_CREATE_INVOICES = 'create-invoices';
    public const CAN_EDIT_INVOICES = 'edit-invoices';
    public const CAN_DELETE_INVOICES = 'delete-invoices';
    public const CAN_SHOW_INVOICES = 'show-invoices';

// Invoice payments permissions
    public const CAN_CREATE_INVOICE_PAYMENTS = 'create-invoice-payments';
    public const CAN_EDIT_INVOICE_PAYMENTS = 'edit-invoice-payments';
    public const CAN_DELETE_INVOICE_PAYMENTS = 'delete-invoice-payments';
    public const CAN_SHOW_INVOICE_PAYMENTS = 'show-invoice-payments';

// Job cards permissions
    public const CAN_CREATE_JOB_CARDS = 'create-job-cards';
    public const CAN_EDIT_JOB_CARDS = 'edit-job-cards';
    public const CAN_DELETE_JOB_CARDS = 'delete-job-cards';
    public const CAN_SHOW_JOB_CARDS = 'show-job-cards';

// Job statuses permissions
    public const CAN_CREATE_JOB_STATUSES = 'create-job-statuses';
    public const CAN_EDIT_JOB_STATUSES = 'edit-job-statuses';
    public const CAN_DELETE_JOB_STATUSES = 'delete-job-statuses';
    public const CAN_SHOW_JOB_STATUSES = 'show-job-statuses';

// Parts permissions
    public const CAN_CREATE_PARTS = 'create-parts';
    public const CAN_EDIT_PARTS = 'edit-parts';
    public const CAN_DELETE_PARTS = 'delete-parts';
    public const CAN_SHOW_PARTS = 'show-parts';

// Payments permissions
    public const CAN_CREATE_PAYMENTS = 'create-payments';
    public const CAN_EDIT_PAYMENTS = 'edit-payments';
    public const CAN_DELETE_PAYMENTS = 'delete-payments';
    public const CAN_SHOW_PAYMENTS = 'show-payments';

// Purchases permissions
    public const CAN_CREATE_PURCHASES = 'create-purchases';
    public const CAN_EDIT_PURCHASES = 'edit-purchases';
    public const CAN_DELETE_PURCHASES = 'delete-purchases';
    public const CAN_SHOW_PURCHASES = 'show-purchases';

// Purchase payments permissions
    public const CAN_CREATE_PURCHASE_PAYMENTS = 'create-purchase-payments';
    public const CAN_EDIT_PURCHASE_PAYMENTS = 'edit-purchase-payments';
    public const CAN_DELETE_PURCHASE_PAYMENTS = 'delete-purchase-payments';
    public const CAN_SHOW_PURCHASE_PAYMENTS = 'show-purchase-payments';

// Quotations permissions
    public const CAN_CREATE_QUOTATIONS = 'create-quotations';
    public const CAN_EDIT_QUOTATIONS = 'edit-quotations';
    public const CAN_DELETE_QUOTATIONS = 'delete-quotations';
    public const CAN_SHOW_QUOTATIONS = 'show-quotations';

// Registration types permissions
    public const CAN_CREATE_REGISTRATION_TYPES = 'create-registration-types';
    public const CAN_EDIT_REGISTRATION_TYPES = 'edit-registration-types';
    public const CAN_DELETE_REGISTRATION_TYPES = 'delete-registration-types';
    public const CAN_SHOW_REGISTRATION_TYPES = 'show-registration-types';

    //Roles
    public const CAN_CREATE_ROLES = 'create-roles';
    public const CAN_EDIT_ROLES = 'edit-roles';
    public const CAN_DELETE_ROLES = 'delete-roles';
    public const CAN_SHOW_ROLES = 'show-roles';

// Salaries permissions
    public const CAN_CREATE_SALARIES = 'create-salaries';
    public const CAN_EDIT_SALARIES = 'edit-salaries';
    public const CAN_DELETE_SALARIES = 'delete-salaries';
    public const CAN_SHOW_SALARIES = 'show-salaries';

// Services permissions
    public const CAN_CREATE_SERVICES = 'create-services';
    public const CAN_EDIT_SERVICES = 'edit-services';
    public const CAN_DELETE_SERVICES = 'delete-services';
    public const CAN_SHOW_SERVICES = 'show-services';

// Settings permissions
    public const CAN_CREATE_SETTINGS = 'create-settings';
    public const CAN_EDIT_SETTINGS = 'edit-settings';
    public const CAN_DELETE_SETTINGS = 'delete-settings';
    public const CAN_SHOW_SETTINGS = 'show-settings';

// Suppliers permissions
    public const CAN_CREATE_SUPPLIERS = 'create-suppliers';
    public const CAN_EDIT_SUPPLIERS = 'edit-suppliers';
    public const CAN_DELETE_SUPPLIERS = 'delete-suppliers';
    public const CAN_SHOW_SUPPLIERS = 'show-suppliers';

// Trainees permissions
    public const CAN_CREATE_TRAINEES = 'create-trainees';
    public const CAN_EDIT_TRAINEES = 'edit-trainees';
    public const CAN_DELETE_TRAINEES = 'delete-trainees';
    public const CAN_SHOW_TRAINEES = 'show-trainees';

    public const CAN_CREATE_LOANS = 'create-loans';
    public const CAN_EDIT_LOANS = 'edit-loans';
    public const CAN_DELETE_LOANS = 'delete-loans';
    public const CAN_SHOW_LOANS = 'show-loans';

    public const CAN_SHOW_CUSTOMERS_REPORT = 'show_customers_report';
    public const CAN_SHOW_CARS_REPORT = 'show_cars_report';
    public const CAN_SHOW_INVOICES_REPORT = 'show_invoices_report';
    public const CAN_SHOW_EXPENSES_REPORT = 'show_expenses_report';
    public const CAN_SHOW_INCOMES_REPORT = 'show_incomes_report';
    public const CAN_SHOW_PURCHASES_REPORT = 'show_purchases_report';
    public const CAN_SHOW_SUMMARY_REPORT = 'show_summary_report';


}
