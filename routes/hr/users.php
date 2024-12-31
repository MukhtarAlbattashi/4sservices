<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Role\CreateRole;
use App\Http\Livewire\Role\RolePage;
use App\Http\Livewire\Role\UpdateRole;
use App\Http\Livewire\Users\Users;

Route::get('/users', Users::class)->name('users')->middleware('can:' . AppPermissions::CAN_SHOW_USERS);
Route::get('/roles', RolePage::class)->name('roles')->middleware('can:' . AppPermissions::CAN_SHOW_ROLES);
Route::get('/create-roles', CreateRole::class)->name('create-roles')->middleware('can:' . AppPermissions::CAN_CREATE_ROLES);
Route::get('/update-roles/{id}', UpdateRole::class)->name('update-roles')->middleware('can:' . AppPermissions::CAN_EDIT_ROLES);
