<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Invoices\AddInvoiceParts;
use App\Http\Livewire\Invoices\AddInvoicesPage;
use App\Http\Livewire\Invoices\AddInvoiceToCar;
use App\Http\Livewire\Invoices\EditInvoicesPage;
use App\Http\Livewire\Invoices\InvoicesAddPayment;
use App\Http\Livewire\Invoices\InvoicesPage;
use App\Http\Livewire\Invoices\InvoicesPayment;
use App\Http\Livewire\Invoices\InvoicesPaymentPrintPage;
use App\Http\Livewire\Invoices\InvoicesView;
use App\Http\Livewire\Quotations\AddQuotationsPage;
use App\Http\Livewire\Quotations\AddQuotationToCar;
use App\Http\Livewire\Quotations\EditQuotationsPage;
use App\Http\Livewire\Quotations\QuotationsPage;
use App\Http\Livewire\Quotations\QuotationsPrint;
use App\Http\Livewire\Quotations\QuotationsView;

Route::get('/{car}/add-quotation', AddQuotationsPage::class)->name('add-quotation')->middleware('can:' . AppPermissions::CAN_CREATE_QUOTATIONS);
Route::get('/{id}/edit-quotation', EditQuotationsPage::class)->name('edit-quotation')->middleware('can:' . AppPermissions::CAN_EDIT_QUOTATIONS);
Route::get('/quotations', QuotationsPage::class)->name('quotations')->middleware('can:' . AppPermissions::CAN_SHOW_QUOTATIONS);
Route::get('/add/quotation', AddQuotationToCar::class)->name('add-quotation-to-car')->middleware('can:' . AppPermissions::CAN_SHOW_CARS);
Route::get('/quotations-view/{id}', QuotationsView::class)->name('quotations-view')->middleware('can:' . AppPermissions::CAN_SHOW_QUOTATIONS);
Route::get('/quotations-print/{id}', QuotationsPrint::class)->name('quotations-print')->middleware('can:' . AppPermissions::CAN_SHOW_QUOTATIONS);
Route::get('/invoices', InvoicesPage::class)->name('invoices')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES);
Route::get('/{car}/add-invoice/{jobCard?}', AddInvoicesPage::class)->name('add-invoice')->middleware('can:' . AppPermissions::CAN_CREATE_INVOICES);
Route::get('/{car}/add-invoice-part/{jobCard?}', AddInvoiceParts::class)->name('add-invoice-part')->middleware('can:' . AppPermissions::CAN_CREATE_INVOICES);
Route::get('/add/invoice', AddInvoiceToCar::class)->name('add-invoice-to-car')->middleware('can:' . AppPermissions::CAN_SHOW_CARS);
Route::get('/{id}/edit-invoice', EditInvoicesPage::class)->name('edit-invoice')->middleware('can:' . AppPermissions::CAN_EDIT_INVOICES);
Route::get('/invoices-add-payment/{id}', InvoicesAddPayment::class)->name('invoices-add-payment')->middleware('can:' . AppPermissions::CAN_CREATE_INVOICE_PAYMENTS);
Route::get('/invoices-payment', InvoicesPayment::class)->name('invoices-payment')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICE_PAYMENTS);
Route::get('/invoices-view/{id}', InvoicesView::class)->name('invoices-view')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICES);
Route::get('/invoices-print-payment/{id}', InvoicesPaymentPrintPage::class)->name('invoices-print-payment')->middleware('can:' . AppPermissions::CAN_SHOW_INVOICE_PAYMENTS);
