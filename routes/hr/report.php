<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Report\CustomersReportPage;
use App\Http\Livewire\Report\ExpensesReport;
use App\Http\Livewire\Report\IncomeReport;
use App\Http\Livewire\Report\InvoiceReport;
use App\Http\Livewire\Report\InvoicesPaymentReport;
use App\Http\Livewire\Report\InvoicesReport;
use App\Http\Livewire\Report\PartsReport;
use App\Http\Livewire\Report\PurchasesReport;
use App\Http\Livewire\Report\SummaryReport;
use App\Http\Livewire\Report\VehiclesReport;
use Illuminate\Support\Facades\Route;

Route::get('/customers-report', CustomersReportPage::class)->name('customers-report')->middleware('can:' . AppPermissions::CAN_SHOW_CUSTOMERS_REPORT);
//Route::get('/invoices-report', InvoicesReport::class)->name('invoices-report')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES_REPORT);
Route::get('/invoice-report', InvoiceReport::class)->name('invoice-report')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES_REPORT);
Route::get('/purchases-report', PurchasesReport::class)->name('purchases-report')->middleware('can:' . AppPermissions::CAN_SHOW_PURCHASES_REPORT);
Route::get('/income-report', IncomeReport::class)->name('income-report')->middleware('can:' . AppPermissions::CAN_SHOW_INCOMES_REPORT);
Route::get('/expenses-report', ExpensesReport::class)->name('expenses-report')->middleware('can:' . AppPermissions::CAN_SHOW_EXPENSES_REPORT);
Route::get('/vehicles-report', VehiclesReport::class)->name('vehicles-report')->middleware('can:' . AppPermissions::CAN_SHOW_CARS_REPORT);
Route::get('/summary-report', SummaryReport::class)->name('summary-report')->middleware('can:' . AppPermissions::CAN_SHOW_SUMMARY_REPORT);
Route::get('/invoices-payment-report', InvoicesPaymentReport::class)->name('invoices-payment-report')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES_REPORT);
Route::get('/parts-report', PartsReport::class)->name('parts-report')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES_REPORT);
