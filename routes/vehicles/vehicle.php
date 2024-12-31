<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Cars\AddCars;
use App\Http\Livewire\Cars\AddCustomerCar;
use App\Http\Livewire\Cars\CarsBrand;
use App\Http\Livewire\Cars\CarsModel;
use App\Http\Livewire\Cars\RegistrationsType;


Route::get('/vehicles', AddCars::class)->name('vehicles')->middleware('can:' . AppPermissions::CAN_SHOW_CARS);
Route::get('/vehicles-brands', CarsBrand::class)->name('vehicles-brands')->middleware('can:' . AppPermissions::CAN_SHOW_CAR_BRANDS);
Route::get('/vehicles-model', CarsModel::class)->name('vehicles-model')->middleware('can:' . AppPermissions::CAN_SHOW_CAR_MODELS);
Route::get('/vehicles-registration-type', RegistrationsType::class)->name('vehicles-registration-type')->middleware('can:' . AppPermissions::CAN_SHOW_REGISTRATION_TYPES);
Route::get('/customer/vehicles/{customerId}', AddCustomerCar::class)->name('customerCar')->middleware('can:' . AppPermissions::CAN_CREATE_CARS);
