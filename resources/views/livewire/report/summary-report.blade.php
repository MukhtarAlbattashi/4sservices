<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="container-fluid">
                    <h3 class="text-center mb-5 text-danger">{{__('public.expense')}} {{__('public.thisMonth')}}</h3>
                    <div class="row g-1 align-items-center justify-content-center">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>{{__('public.expenses')}}</th>
                                <th>{{__('public.amount')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('public.contracts')}}</td>
                                <td>{{number_format($totalContracts,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.salaries')}}</td>
                                <td>{{number_format($totalSalaries,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.expenses')}}</td>
                                <td>{{number_format($totalExpenses,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.allowances')}}</td>
                                <td>{{number_format($totalAllowances,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.assets')}}</td>
                                <td>{{number_format($totalAssets,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.purchase')}}</td>
                                <td>{{number_format($totalPurchase,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.loans')}}</td>
                                <td>{{number_format($totalLoans,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container-fluid">
                    <h3 class="text-center mb-5 text-success">{{__('public.incomes')}} {{__('public.thisMonth')}}</h3>
                    <div class="row g-1 align-items-center justify-content-center">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>{{__('public.incomes')}}</th>
                                <th>{{__('public.amount')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('public.totalInvoicesPayment')}}</td>
                                <td>{{number_format($totalInvoicesPayment,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.totalDiscount')}}</td>
                                <td>{{number_format($totalDiscount,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.totalIncomes')}}</td>
                                <td>{{number_format($totalIncomes,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            <tr>
                                <td>{{__('public.totalInvoicesRimine')}}</td>
                                <td>{{number_format($totalInvoicesRimine,3)}} {{__('public.OMR')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="row g-1 align-items-center justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center text-dark" style="background-color: #ffce56">
                                <h4>{{__('public.total')}} {{__('public.expense')}} {{__('public.thisMonth')}}</h4>
                            </div>
                            <div class="card-body text-center">
                                <h5>{{number_format($totalAllOfExpenses,3)}} {{__('public.OMR')}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center text-white" style="background-color: #22a6b3">
                                <h4>{{__('public.total')}} {{__('public.profits')}} {{__('public.thisMonth')}}</h4>
                            </div>
                            <div class="card-body text-center">
                                <h5>
                                    <span
                                        class="{{ $profit > 0 ? 'fas fa-arrow-circle-up text-success' : 'fas fa-arrow-circle-down text-danger' }}"></span>
                                    {{number_format($profit,3)}} {{__('public.OMR')}}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center text-white" style="background-color: #6ab04c">
                                <h4>{{__('public.total')}} {{__('public.incomes')}} {{__('public.thisMonth')}}</h4>
                            </div>
                            <div class="card-body text-center">
                                <h5>{{number_format($totalAllOfIncomes,3)}} {{__('public.OMR')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>


