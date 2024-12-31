<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Purchases\AddPurchasesPage;
use App\Http\Livewire\Purchases\EditPurchasesPage;
use App\Http\Livewire\Purchases\PurchasesAddPayment;
use App\Http\Livewire\Purchases\PurchasesPage;
use App\Http\Livewire\Purchases\PurchasesPayment;
use App\Http\Livewire\Purchases\PurchasesPaymentPrintPage;
use App\Http\Livewire\Purchases\PurchasesView;

Route::get('/purchases', PurchasesPage::class)->name('purchases')->middleware('can:' . AppPermissions::CAN_SHOW_PURCHASES);
Route::get('/add-purchases', AddPurchasesPage::class)->name('add-purchases')->middleware('can:' . AppPermissions::CAN_CREATE_PURCHASES);
Route::get('/purchases-payment', PurchasesPayment::class)->name('purchases-payment')->middleware('can:' . AppPermissions::CAN_SHOW_PURCHASE_PAYMENTS);
Route::get('/purchases-edit/{id}', EditPurchasesPage::class)->name('purchases-edit')->middleware('can:' . AppPermissions::CAN_EDIT_PURCHASES);
Route::get('/purchases-view/{id}', PurchasesView::class)->name('purchases-view')->middleware('can:' . AppPermissions::CAN_SHOW_PURCHASES);
Route::get('/purchases-add-payment/{id}', PurchasesAddPayment::class)->name('purchases-add-payment')->middleware('can:' . AppPermissions::CAN_CREATE_PURCHASE_PAYMENTS);
Route::get('/purchases-print-payment/{id}', PurchasesPaymentPrintPage::class)->name('purchases-print-payment')->middleware('can:' . AppPermissions::CAN_SHOW_PURCHASE_PAYMENTS);
