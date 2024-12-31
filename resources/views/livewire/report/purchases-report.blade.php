<div>
    <div class="container">
    <h3 class="text-center mb-5 text-danger">{{__('public.purchasesReports')}}</h3>
        <div class="row g-4">
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[0] }}" color="{{ $colors[0] }}" title="{{__('public.thisWeek')}}" subtitle="{{number_format($thisWeek, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[1] }}" color="{{ $colors[1] }}" title="{{__('public.thisMonth')}}" subtitle="{{number_format($thisMonth, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[2] }}" color="{{ $colors[2] }}" title="{{__('public.lastThreeMonths')}}" subtitle="{{number_format($lastThreeMonths, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[3] }}" color="{{ $colors[3] }}" title="{{__('public.lastSixMonths')}}" subtitle="{{number_format($lastSixMonths, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[4] }}" color="{{ $colors[4] }}" title="{{__('public.thisYear')}}" subtitle="{{number_format($thisYear, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4">
                <x-report-card backColor="{{ $backColors[5] }}" color="{{ $colors[5] }}" title="{{__('public.allYears')}}" subtitle="{{number_format($previousYears, 3)}} {{__('public.OMR')}}">
                </x-report-card>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered  text-center table-sm">
                    <tr>
                        <td colspan="5" class=" fs-5 text-danger">
                            {{__('public.lastPurchases')}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('public.supplierName')}}</td>
                        <td>{{__('public.sub-total')}}</td>
                        <td>{{__('public.taxAmount')}}</td>
                        <td>{{__('public.discount')}}</td>
                        <td>{{__('public.totalAmount')}}</td>
                    </tr>
                    @foreach($categorySums as $category)
                    <tr>
                        <td>{{$category->supplier->name}}</td>
                        <td>{{number_format($category->sub_total,3)}} {{__('public.OMR')}}</td>
                        <td>{{$category->tax}}%</td>
                        <td>{{number_format($category->discount,3)}} {{__('public.OMR')}}</td>
                        <td>{{number_format($category->total,3)}} {{__('public.OMR')}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered  text-center table-sm">
                    <tr>
                        <td colspan="4" class=" fs-5 text-danger">
                            {{__('public.lastPurchasesPayment')}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{__('public.supplierName')}}</td>
                        <td>{{__('public.paid')}}</td>
                        <td>{{__('public.restAmount')}}</td>
                        <td>{{__('public.about')}}</td>
                    </tr>
                    @foreach($subCategorySums as $category)
                    <tr>
                        <td>{{$category->purchase->supplier->name}}</td>
                        <td>{{number_format($category->amount,3)}} {{__('public.OMR')}}</td>
                        <td>{{number_format($category->remine,3)}} {{__('public.OMR')}}</td>
                        <td>{{$category->about}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">{{__('public.thisYear')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-bordered align-middle text-center">
                                    <tr class="bg-light">
                                        <td>{{__('public.totalAll')}}</td>
                                        <td>{{__('public.discount')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems2['total'],3)}} {{__('public.OMR')}}</td>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems2['discount'],3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>{{__('public.paid')}}</td>
                                        <td>{{__('public.restAmount')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems2['amount'],3)}} {{__('public.OMR')}}</td>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems2['remine'],3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2">{{__('public.taxAmount')}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-danger fst-italic">
                                        {{$invoiceItems['tax']}}% ({{number_format(($invoiceItems['total']*$invoiceItems['tax']/100),3)}} {{__('public.OMR')}})
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <canvas id="invoiceThisYear"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">{{__('public.allYears')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-bordered align-middle text-center">
                                    <tr class="bg-light">
                                        <td>{{__('public.totalAll')}}</td>
                                        <td>{{__('public.discount')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems['total'],3)}} {{__('public.OMR')}}</td>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems['discount'],3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>{{__('public.paid')}}</td>
                                        <td>{{__('public.restAmount')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems['amount'],3)}} {{__('public.OMR')}}</td>
                                        <td class="text-danger fst-italic">{{number_format($invoiceItems['remine'],3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2">{{__('public.taxAmount')}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-danger fst-italic">
                                            {{$invoiceItems['tax']}}% ({{number_format(($invoiceItems['total']*$invoiceItems['tax']/100),3)}} {{__('public.OMR')}})
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <canvas id="invoice"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const plugin = {
            id: 'customCanvasBackgroundColor',
            beforeDraw: (chart, args, options) => {
                const {
                    ctx
                } = chart;
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = options.color || '#ffffff';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            }
        };
        const option = {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16,
                            weight: 'bold',
                            family: 'monadi',
                        }
                    }
                },
            }
        };
        Chart.defaults.font.family = 'monadi';
        Chart.defaults.font.size = 16;
        const invoicesData = {!!$invoices!!};
        const invoice = document.getElementById('invoice');
        new Chart(invoice, {
            type: 'doughnut',
            data: invoicesData,
            options: option,
            plugins: [plugin],
        });
        const invoicesData2 = {!!$invoices2!!};
        const invoice2 = document.getElementById('invoiceThisYear');
        new Chart(invoice2, {
            type: 'doughnut',
            data: invoicesData2,
            options: option,
            plugins: [plugin],
        });
    </script>


</div>