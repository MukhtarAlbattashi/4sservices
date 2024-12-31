<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
    <li class="nav-item">
        <a class="nav-link text-dark hover-item {{ request()->routeIs('home') ? 'selected-item' : '' }}"
           href="{{route('home')}}">
            <span class="fas fa-house"></span> {{__('public.home')}}
        </a>
    </li>
    @can(\App\Enums\AppPermissions::CAN_SHOW_CUSTOMERS)
        <li class="nav-item">
            <a class="nav-link text-dark hover-item {{ request()->routeIs('customers') ? 'selected-item' : '' }}"
               href="{{route('customers')}}">
                <span class="fas fa-users"></span> {{__('public.customers')}}
            </a>
        </li>
    @endcan
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink1"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-car"></span> {{__('public.vehicles')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink1">

            <li><a class="dropdown-item {{ request()->routeIs('vehicles') ? 'selected-item' : '' }}"
                   href="{{route('vehicles')}}">{{__('public.addNewCar')}}</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('vehicles-brands') ? 'selected-item' : '' }}"
                   href="{{route('vehicles-brands')}}">{{__('public.brandsCars')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('vehicles-model') ? 'selected-item' : '' }}"
                   href="{{route('vehicles-model')}}">{{__('public.carsModels')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('vehicles-registration-type') ? 'selected-item' : '' }}"
                   href="{{route('vehicles-registration-type')}}">{{__('public.registrationType')}}</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink2JopCard"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-credit-card"></span> {{__('public.jopCards')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2JopCard">
            <li><a class="dropdown-item {{ request()->routeIs('jop-cards-view') ? 'selected-item' : '' }}"
                   href="{{route('jop-cards-view')}}">{{__('public.viewAllJopCards')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('jop-cards-status') ? 'selected-item' : '' }}"
                   href="{{route('jop-cards-status')}}">{{__('public.jopCardsStatus')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-file-invoice-dollar"></span> {{__('public.invoices/jobCards')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
            <li><a class="dropdown-item {{ request()->routeIs('invoices') ? 'selected-item' : '' }}"
                   href="{{route('invoices')}}">{{__('public.addInvoice')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('invoices-payment') ? 'selected-item' : '' }}"
                   href="{{route('invoices-payment')}}">{{__('public.payments')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('quotations') ? 'selected-item' : '' }}"
                   href="{{route('quotations')}}">{{__('public.addQuotation')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink3"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-store"></span> {{__('public.stock')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink3">
            <li><a class="dropdown-item {{ request()->routeIs('services') ? 'selected-item' : '' }}"
                   href="{{route('services')}}">{{__('public.services')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('parts') ? 'selected-item' : '' }}"
                   href="{{route('parts')}}">
                    {{__('public.parts')}}
                </a>
            </li>
            <li><a class="dropdown-item {{ request()->routeIs('suppliers') ? 'selected-item' : '' }}"
                   href="{{route('suppliers')}}">{{__('public.suppliers')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('purchases') ? 'selected-item' : '' }}"
                   href="{{route('purchases')}}">{{__('public.purchases')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('purchases-payment') ? 'selected-item' : '' }}"
                   href="{{route('purchases-payment')}}">{{__('public.paymentsPurchases')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink4"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-warehouse"></span> {{__('public.assets')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink4">
            <li><a class="dropdown-item {{ request()->routeIs('assets') ? 'selected-item' : '' }}"
                   href="{{route('assets')}}">{{__('public.addAssets')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('asset-category') ? 'selected-item' : '' }}"
                   href="{{route('asset-category')}}">{{__('public.assetsCategories')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('asset-sub-category') ? 'selected-item' : '' }}"
                   href="{{route('asset-sub-category')}}">{{__('public.assetsSubCategories')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink5"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-dollar"></span> {{__('public.incomes')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink5">
            <li><a class="dropdown-item {{ request()->routeIs('incomes') ? 'selected-item' : '' }}"
                   href="{{route('incomes')}}">{{__('public.addIncomes')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('income-category') ? 'selected-item' : '' }}"
                   href="{{route('income-category')}}">{{__('public.incomesCategories')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('income-sub-category') ? 'selected-item' : '' }}"
                   href="{{route('income-sub-category')}}">{{__('public.incomesSubCategories')}}</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink6"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-dollar"></span> {{__('public.expenses')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink6">
            <li><a class="dropdown-item {{ request()->routeIs('expenses') ? 'selected-item' : '' }}"
                   href="{{route('expenses')}}">{{__('public.addExpenses')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('expense-category') ? 'selected-item' : '' }}"
                   href="{{route('expense-category')}}">{{__('public.expensesCategories')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('expense-sub-category') ? 'selected-item' : '' }}"
                   href="{{route('expense-sub-category')}}">{{__('public.expensesSubCategories')}}</a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link text-dark hover-item {{ request()->routeIs('loans') ? 'selected-item' : '' }}"
           href="{{route('loans')}}">
            <span class="fas fa-dollar-sign"></span> {{__('public.loans')}}
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink7"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-chart-line"></span> {{__('public.reportsGarage')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink7">
            <li>
                <a class="dropdown-item {{ request()->routeIs('customers-report') ? 'selected-item' : '' }}"
                   href="{{route('customers-report')}}">{{__('public.customersReports')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('vehicles-report') ? 'selected-item' : '' }}"
                   href="{{route('vehicles-report')}}">{{__('public.carsReports')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('invoice-report') ? 'selected-item' : '' }}"
                   href="{{route('invoice-report')}}">{{__('public.invoicesReports')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('invoices-payment-report') ? 'selected-item' : '' }}"
                   href="{{route('invoices-payment-report')}}">{{__('public.invoicePaymentsReport')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('parts-report') ? 'selected-item' : '' }}"
                   href="{{route('parts-report')}}">{{__('public.parts-report')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('expenses-report') ? 'selected-item' : '' }}"
                   href="{{route('expenses-report')}}">{{__('public.expensesReport')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('income-report') ? 'selected-item' : '' }}"
                   href="{{route('income-report')}}">{{__('public.incomesReport')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('purchases-report') ? 'selected-item' : '' }}"
                   href="{{route('purchases-report')}}">{{__('public.purchasesReports')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('summary-report') ? 'selected-item' : '' }}"
                   href="{{route('summary-report')}}">{{__('public.reportsAll')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink8"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-user-tie"></span> {{__('public.hr')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink8">
            <li><a class="dropdown-item {{ request()->routeIs('trianees') ? 'selected-item' : '' }}"
                   href="{{route('trianees')}}">{{__('public.trainees')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('employee-categories') ? 'selected-item' : '' }}"
                   href="{{route('employee-categories')}}">{{__('public.categoriesEmployees')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('employees') ? 'selected-item' : '' }}"
                   href="{{route('employees')}}">{{__('public.employees')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('contracts') ? 'selected-item' : '' }}"
                   href="{{route('contracts')}}">{{__('public.contracts')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('salaries') ? 'selected-item' : '' }}"
                   href="{{route('salaries')}}">{{__('public.salaries')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('holidays-categories') ? 'selected-item' : '' }}"
                   href="{{route('holidays-categories')}}">{{__('public.categoriesHolidays')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('holidays') ? 'selected-item' : '' }}"
                   href="{{route('holidays')}}">{{__('public.holidays')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('allowances-categories') ? 'selected-item' : '' }}"
                   href="{{route('allowances-categories')}}">{{__('public.categoriesAllowances')}}</a>
            </li>
            <li><a class="dropdown-item {{ request()->routeIs('allowances') ? 'selected-item' : '' }}"
                   href="{{route('allowances')}}">{{__('public.allowances')}}</a></li>
            <li>
                <a class="dropdown-item {{ request()->routeIs('discounts-categories') ? 'selected-item' : '' }}"
                   href="{{route('discounts-categories')}}">{{__('public.categoriesDiscounts')}}</a>
            </li>
            <li><a class="dropdown-item {{ request()->routeIs('discounts') ? 'selected-item' : '' }}"
                   href="{{route('discounts')}}">{{__('public.discounts')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('courses') ? 'selected-item' : '' }}"
                   href="{{route('courses')}}">{{__('public.employeesCourse')}}</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink9"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-gears"></span> {{__('public.administration')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink9">
            <li><a class="dropdown-item {{ request()->routeIs('users') ? 'selected-item' : '' }}"
                   href="{{route('users')}}">{{__('public.users')}}</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('roles') ? 'selected-item' : '' }}"
                   href="{{route('roles')}}">{{__('public.roles')}}</a></li>

            <li><a class="dropdown-item {{ request()->routeIs('settings') ? 'selected-item' : '' }}"
                   href="{{route('settings')}}">{{__('public.settings')}}</a></li>

            <li>
                <a class="dropdown-item {{ request()->routeIs('payment-methods') ? 'selected-item' : '' }}"
                   href="{{route('payment-methods')}}">{{__('public.paymentMethods')}}</a></li>

        </ul>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link text-dark hover-item dropdown-toggle" href="#" id="navbarDropdownMenuLink10"
           role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-language"></span> {{__('public.language')}}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink10">
            <li>
                <a class="dropdown-item" href="{{ url('/language/ar') }}">العربية</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('/language/en') }}">EN</a>
            </li>
        </ul>
    </li>
</ul>

<div class="d-grid gap-2  pe-3 mt-3">
    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        {{__('public.logout')}}
    </a>
    <form method="POST" id="logout-form" action="{{ route('logout') }}">
        @csrf
    </form>
</div>
