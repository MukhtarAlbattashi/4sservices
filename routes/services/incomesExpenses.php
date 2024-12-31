<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Asset\AssetPage;
use App\Http\Livewire\Asset\AssetsCategories;
use App\Http\Livewire\Asset\AssetsSubCategories;
use App\Http\Livewire\Expense\ExpensePage;
use App\Http\Livewire\Expense\ExpensesCategories;
use App\Http\Livewire\Expense\ExpensesSubCategories;
use App\Http\Livewire\Income\IncomePage;
use App\Http\Livewire\Income\IncomesCategories;
use App\Http\Livewire\Income\IncomesSubCategories;
use App\Http\Livewire\Services\PartsPage;
use App\Http\Livewire\Services\ServicesPage;
use App\Http\Livewire\Suppliers\SuppliersPage;

Route::get('/expense-category', ExpensesCategories::class)->name('expense-category')->middleware('can:' . AppPermissions::CAN_SHOW_EXPENSE_CATEGORIES);
Route::get('/expense-sub-category', ExpensesSubCategories::class)->name('expense-sub-category')->middleware('can:' . AppPermissions::CAN_SHOW_EXPENSE_SUBCATEGORIES);
Route::get('/expenses', ExpensePage::class)->name('expenses')->middleware('can:' . AppPermissions::CAN_SHOW_EXPENSES);
Route::get('/income-category', IncomesCategories::class)->name('income-category')->middleware('can:' . AppPermissions::CAN_SHOW_INCOME_CATEGORIES);
Route::get('/income-sub-category', IncomesSubCategories::class)->name('income-sub-category')->middleware('can:' . AppPermissions::CAN_SHOW_INCOME_SUBCATEGORIES);
Route::get('/incomes', IncomePage::class)->name('incomes')->middleware('can:' . AppPermissions::CAN_SHOW_INCOMES);
Route::get('/asset-category', AssetsCategories::class)->name('asset-category')->middleware('can:' . AppPermissions::CAN_SHOW_ASSET_CATEGORIES);
Route::get('/asset-sub-category', AssetsSubCategories::class)->name('asset-sub-category')->middleware('can:' . AppPermissions::CAN_SHOW_ASSET_SUBCATEGORIES);
Route::get('/assets', AssetPage::class)->name('assets')->middleware('can:' . AppPermissions::CAN_SHOW_ASSETS);
Route::get('/services', ServicesPage::class)->name('services')->middleware('can:' . AppPermissions::CAN_SHOW_SERVICES);
Route::get('/parts', PartsPage::class)->name('parts')->middleware('can:' . AppPermissions::CAN_SHOW_PARTS);
Route::get('/suppliers', SuppliersPage::class)->name('suppliers')->middleware('can:' . AppPermissions::CAN_SHOW_SUPPLIERS);
