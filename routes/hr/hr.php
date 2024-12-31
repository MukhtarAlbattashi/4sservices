<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Allowance\AddAllowance;
use App\Http\Livewire\Allowance\AllowanceCategories;
use App\Http\Livewire\Allowance\AllowancePage;
use App\Http\Livewire\Allowance\EditAllowance;
use App\Http\Livewire\Contract\AddContract;
use App\Http\Livewire\Contract\ContractsPage;
use App\Http\Livewire\Contract\EditContract;
use App\Http\Livewire\Contract\ViewContract;
use App\Http\Livewire\Course\AddCourse;
use App\Http\Livewire\Course\CoursePage;
use App\Http\Livewire\Course\EditCourse;
use App\Http\Livewire\Discounts\AddDiscount;
use App\Http\Livewire\Discounts\DiscountPage;
use App\Http\Livewire\Discounts\DiscountsCategories;
use App\Http\Livewire\Discounts\EditDiscount;
use App\Http\Livewire\Employee\AddEmployee;
use App\Http\Livewire\Employee\EditEmployee;
use App\Http\Livewire\Employee\EmployeesCategories;
use App\Http\Livewire\Employee\EmployeesPage;
use App\Http\Livewire\Employee\ViewEmployee;
use App\Http\Livewire\Holiday\AddHoliday;
use App\Http\Livewire\Holiday\EditHoliday;
use App\Http\Livewire\Holiday\HolidaiesCategories;
use App\Http\Livewire\Holiday\HolidaysPage;
use App\Http\Livewire\Salary\AddSalary;
use App\Http\Livewire\Salary\EditSalary;
use App\Http\Livewire\Salary\SalariesPage;
use App\Http\Livewire\Trainees\AddTrainees;
use App\Http\Livewire\Trainees\EditTrainees;
use App\Http\Livewire\Trainees\TraineesPage;
use App\Http\Livewire\Trainees\ViewTrainees;

Route::get('/trianees', TraineesPage::class)->name('trianees')->middleware('can:' . AppPermissions::CAN_SHOW_TRAINEES);
Route::get('/trianees/create', AddTrainees::class)->name('add-trianees')->middleware('can:' . AppPermissions::CAN_CREATE_TRAINEES);
Route::get('/trianees/edit/{id}', EditTrainees::class)->name('edit-trianees')->middleware('can:' . AppPermissions::CAN_EDIT_TRAINEES);
Route::get('/trianees/view/{id}', ViewTrainees::class)->name('view-trianees')->middleware('can:' . AppPermissions::CAN_SHOW_TRAINEES);
Route::get('/employee/categories', EmployeesCategories::class)->name('employee-categories')->middleware('can:' . AppPermissions::CAN_SHOW_EMPLOYEE_CATEGORIES);
Route::get('/employees', EmployeesPage::class)->name('employees')->middleware('can:' . AppPermissions::CAN_SHOW_EMPLOYEES);
Route::get('/employee/create', AddEmployee::class)->name('employee-create')->middleware('can:' . AppPermissions::CAN_CREATE_EMPLOYEES);
Route::get('/employee/edit/{id}', EditEmployee::class)->name('edit-employee')->middleware('can:' . AppPermissions::CAN_EDIT_EMPLOYEES);
Route::get('/employee/view/{id}', ViewEmployee::class)->name('view-employee')->middleware('can:' . AppPermissions::CAN_SHOW_EMPLOYEES);
Route::get('/contracts', ContractsPage::class)->name('contracts')->middleware('can:' . AppPermissions::CAN_SHOW_CONTRACTS);
Route::get('/contract/create', AddContract::class)->name('contract-create')->middleware('can:' . AppPermissions::CAN_CREATE_CONTRACTS);
Route::get('/contract/edit/{id}', EditContract::class)->name('edit-contract')->middleware('can:' . AppPermissions::CAN_EDIT_CONTRACTS);
Route::get('/contract/view/{id}', ViewContract::class)->name('view-contract')->middleware('can:' . AppPermissions::CAN_SHOW_CONTRACTS);
Route::get('/salaries', SalariesPage::class)->name('salaries')->middleware('can:' . AppPermissions::CAN_SHOW_SALARIES);
Route::get('/salary/create', AddSalary::class)->name('salary-create')->middleware('can:' . AppPermissions::CAN_CREATE_SALARIES);
Route::get('/salary/edit/{id}', EditSalary::class)->name('edit-salary')->middleware('can:' . AppPermissions::CAN_EDIT_SALARIES);
Route::get('/holidays/categories', HolidaiesCategories::class)->name('holidays-categories')->middleware('can:' . AppPermissions::CAN_SHOW_HOLIDAY_CATEGORIES);
Route::get('/holidays', HolidaysPage::class)->name('holidays')->middleware('can:' . AppPermissions::CAN_SHOW_HOLIDAYS);
Route::get('/holiday/create', AddHoliday::class)->name('holiday-create')->middleware('can:' . AppPermissions::CAN_CREATE_HOLIDAYS);
Route::get('/holiday/edit/{id}', EditHoliday::class)->name('edit-holiday')->middleware('can:' . AppPermissions::CAN_EDIT_HOLIDAYS);
Route::get('/allowances/categories', AllowanceCategories::class)->name('allowances-categories')->middleware('can:' . AppPermissions::CAN_SHOW_ALLOWANCE_CATEGORIES);
Route::get('/allowances', AllowancePage::class)->name('allowances')->middleware('can:' . AppPermissions::CAN_SHOW_ALLOWANCES);
Route::get('/allowance/create', AddAllowance::class)->name('allowance-create')->middleware('can:' . AppPermissions::CAN_CREATE_ALLOWANCES);
Route::get('/allowance/edit/{id}', EditAllowance::class)->name('edit-allowance')->middleware('can:' . AppPermissions::CAN_EDIT_ALLOWANCES);
Route::get('/discounts/categories', DiscountsCategories::class)->name('discounts-categories')->middleware('can:' . AppPermissions::CAN_SHOW_DISCOUNT_CATEGORIES);
Route::get('/discounts', DiscountPage::class)->name('discounts')->middleware('can:' . AppPermissions::CAN_SHOW_DISCOUNTS);
Route::get('/discount/create', AddDiscount::class)->name('discount-create')->middleware('can:' . AppPermissions::CAN_CREATE_DISCOUNTS);
Route::get('/discount/edit/{id}', EditDiscount::class)->name('edit-discount')->middleware('can:' . AppPermissions::CAN_EDIT_DISCOUNTS);
Route::get('/courses', CoursePage::class)->name('courses')->middleware('can:' . AppPermissions::CAN_SHOW_COURSES);
Route::get('/course/create', AddCourse::class)->name('course-create')->middleware('can:' . AppPermissions::CAN_CREATE_COURSES);
Route::get('/course/edit/{id}', EditCourse::class)->name('edit-course')->middleware('can:' . AppPermissions::CAN_EDIT_COURSES);