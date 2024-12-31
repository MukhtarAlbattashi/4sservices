<?php

use App\Enums\AppPermissions;
use App\Http\Livewire\Allowance\AddAllowance;
use App\Http\Livewire\Allowance\AllowanceCategories;
use App\Http\Livewire\Allowance\AllowancePage;
use App\Http\Livewire\Allowance\EditAllowance;
use App\Http\Livewire\Asset\AssetPage;
use App\Http\Livewire\Asset\AssetsCategories;
use App\Http\Livewire\Asset\AssetsSubCategories;
use App\Http\Livewire\Cars\AddCars;
use App\Http\Livewire\Cars\AddCustomerCar;
use App\Http\Livewire\Cars\CarsBrand;
use App\Http\Livewire\Cars\CarsModel;
use App\Http\Livewire\Cars\RegistrationsType;
use App\Http\Livewire\Contract\AddContract;
use App\Http\Livewire\Contract\ContractsPage;
use App\Http\Livewire\Contract\EditContract;
use App\Http\Livewire\Contract\ViewContract;
use App\Http\Livewire\Course\AddCourse;
use App\Http\Livewire\Course\CoursePage;
use App\Http\Livewire\Course\EditCourse;
use App\Http\Livewire\Customers\Customers;
use App\Http\Livewire\Customers\CustomersSummary;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Discounts\AddDiscount;
use App\Http\Livewire\Discounts\DiscountPage;
use App\Http\Livewire\Discounts\DiscountsCategories;
use App\Http\Livewire\Discounts\EditDiscount;
use App\Http\Livewire\Employee\AddEmployee;
use App\Http\Livewire\Employee\EditEmployee;
use App\Http\Livewire\Employee\EmployeesCategories;
use App\Http\Livewire\Employee\EmployeesPage;
use App\Http\Livewire\Employee\ViewEmployee;
use App\Http\Livewire\Expense\ExpensePage;
use App\Http\Livewire\Expense\ExpensesCategories;
use App\Http\Livewire\Expense\ExpensesSubCategories;
use App\Http\Livewire\Holiday\AddHoliday;
use App\Http\Livewire\Holiday\EditHoliday;
use App\Http\Livewire\Holiday\HolidaiesCategories;
use App\Http\Livewire\Holiday\HolidaysPage;
use App\Http\Livewire\Income\IncomePage;
use App\Http\Livewire\Income\IncomesCategories;
use App\Http\Livewire\Income\IncomesSubCategories;
use App\Http\Livewire\Invoices\AddInvoiceParts;
use App\Http\Livewire\Invoices\AddInvoicesPage;
use App\Http\Livewire\Invoices\AddInvoiceToCar;
use App\Http\Livewire\Invoices\EditInvoicesPage;
use App\Http\Livewire\Invoices\InvoicesAddPayment;
use App\Http\Livewire\Invoices\InvoicesDetailsUuid;
use App\Http\Livewire\Invoices\InvoicesPage;
use App\Http\Livewire\Invoices\InvoicesPayment;
use App\Http\Livewire\Invoices\InvoicesPaymentPrintPage;
use App\Http\Livewire\Invoices\InvoicesView;
use App\Http\Livewire\Invoices\InvoicesViewUuid;
use App\Http\Livewire\JopCards\AddJopCard;
use App\Http\Livewire\JopCards\AddJopCardToCar;
use App\Http\Livewire\JopCards\EditJopCard;
use App\Http\Livewire\JopCards\JopCardsPrint;
use App\Http\Livewire\JopCards\JopCardsStatus;
use App\Http\Livewire\JopCards\JopCardViewPage;
use App\Http\Livewire\JopCards\JopCradsPage;
use App\Http\Livewire\Loans\LoansPage;
use App\Http\Livewire\Payment\PaymentMethods;
use App\Http\Livewire\Purchases\AddPurchasesPage;
use App\Http\Livewire\Purchases\EditPurchasesPage;
use App\Http\Livewire\Purchases\PurchasesAddPayment;
use App\Http\Livewire\Purchases\PurchasesPage;
use App\Http\Livewire\Purchases\PurchasesPayment;
use App\Http\Livewire\Purchases\PurchasesPaymentPrintPage;
use App\Http\Livewire\Purchases\PurchasesView;
use App\Http\Livewire\Quotations\AddQuotationsPage;
use App\Http\Livewire\Quotations\AddQuotationToCar;
use App\Http\Livewire\Quotations\EditQuotationsPage;
use App\Http\Livewire\Quotations\QuotationsPage;
use App\Http\Livewire\Quotations\QuotationsPrint;
use App\Http\Livewire\Quotations\QuotationsView;
use App\Http\Livewire\Report\CustomersReportPage;
use App\Http\Livewire\Report\ExpensesReport;
use App\Http\Livewire\Report\IncomeReport;
use App\Http\Livewire\Report\InvoicesReport;
use App\Http\Livewire\Report\PurchasesReport;
use App\Http\Livewire\Report\SummaryReport;
use App\Http\Livewire\Report\VehiclesReport;
use App\Http\Livewire\Role\CreateRole;
use App\Http\Livewire\Role\RolePage;
use App\Http\Livewire\Role\UpdateRole;
use App\Http\Livewire\Salary\AddSalary;
use App\Http\Livewire\Salary\EditSalary;
use App\Http\Livewire\Salary\SalariesPage;
use App\Http\Livewire\Services\PartsPage;
use App\Http\Livewire\Services\ServicesPage;
use App\Http\Livewire\Settings\SettingPage;
use App\Http\Livewire\Suppliers\SuppliersPage;
use App\Http\Livewire\Trainees\AddTrainees;
use App\Http\Livewire\Trainees\EditTrainees;
use App\Http\Livewire\Trainees\TraineesPage;
use App\Http\Livewire\Trainees\ViewTrainees;
use App\Http\Livewire\Users\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return to_route('home');
    });
    Route::get('/home', Dashboard::class)->name('home');
    Route::get('/customers', Customers::class)->name('customers')->middleware('can:' . AppPermissions::CAN_SHOW_CUSTOMERS);
    Route::get('/customers-summary', CustomersSummary::class)->name('customers-summary')->middleware('can:' . AppPermissions::CAN_SHOW_CUSTOMERS);
    Route::get('/payment-methods', PaymentMethods::class)->name('payment-methods')->middleware('can:' . AppPermissions::CAN_SHOW_PAYMENTS);
    Route::get('/settings', SettingPage::class)->name('settings')->middleware('can:' . AppPermissions::CAN_SHOW_SETTINGS);
    Route::get('/loans', LoansPage::class)->name('loans')->middleware('can:' . AppPermissions::CAN_SHOW_LOANS);
});

Route::get('/customers-invoices-details/{uuid}', InvoicesDetailsUuid::class)->name('invoices-details-uuid');
Route::get('/customers-invoices-view/{uuid}', InvoicesViewUuid::class)->name('invoices-view-uuid');

//Route::get('/send-mail-test', function () {
//    \Mail::raw('This is a test email from Garage App', function ($message) {
//        $message->from('alafaq.app@gmail.com', 'Garage App');
//        $message->to('mukhtaralbattashi@gmail.com');
//        $message->subject('Test Email from Garage App');
//    });
//
//    return 'A test email has been sent!';
//});

