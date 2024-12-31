<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\JopCards\AddJopCard;
use App\Http\Livewire\JopCards\AddJopCardToCar;
use App\Http\Livewire\JopCards\EditJopCard;
use App\Http\Livewire\JopCards\JopCardsPrint;
use App\Http\Livewire\JopCards\JopCardsStatus;
use App\Http\Livewire\JopCards\JopCardViewPage;
use App\Http\Livewire\JopCards\JopCradsPage;

Route::get('/{car}/add-jop-card', AddJopCard::class)->name('add-jop-card')->middleware('can:' . AppPermissions::CAN_CREATE_JOB_CARDS);
Route::get('/add/job-card', AddJopCardToCar::class)->name('add-job-card-to-car')->middleware('can:' . AppPermissions::CAN_SHOW_CARS);
Route::get('/{car}/edit-jop-card/{job?}', EditJopCard::class)->name('edit-jop-card')->middleware('can:' . AppPermissions::CAN_EDIT_JOB_CARDS);
Route::get('/{car}/view-jop-card/{job}', JopCardViewPage::class)->name('view-jop-card')->middleware('can:' . AppPermissions::CAN_SHOW_JOB_CARDS);
Route::get('/{car}/print-jop-card/{job}', JopCardsPrint::class)->name('print-jop-card')->middleware('can:' . AppPermissions::CAN_SHOW_JOB_CARDS);
Route::get('/jop-cards-status', JopCardsStatus::class)->name('jop-cards-status')->middleware('can:' . AppPermissions::CAN_SHOW_JOB_STATUSES);
Route::get('/jop-cards-view', JopCradsPage::class)->name('jop-cards-view')->middleware('can:' . AppPermissions::CAN_SHOW_JOB_CARDS);
