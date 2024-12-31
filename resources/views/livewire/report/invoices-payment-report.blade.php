<div>
    <div class="container">
    <h3 class="text-center mb-5 text-danger">{{__('public.invoicePaymentsReport')}}</h3>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">{{__('public.thisYear')}} ({{__('public.bOMR')}})</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-bordered align-middle text-center table-sm" style="background-color: #FDFDFD;">
                                    @foreach($items2 as $item)
                                        <tr>
                                            <td>{{__('public.'. $item['month_name'])}}</td>
                                            <td style="font-style: italic;">{{number_format($item['total'],3)}} {{__('public.OMR')}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-danger ">{{__('public.totalAll')}}</td>
                                        <td class="text-danger ">{{number_format($total2, 3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <canvas id="thisYear"></canvas>
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
                        <h4 class="text-center">{{__('public.allYears')}} ({{__('public.bOMR')}})</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <table class="table table-bordered align-middle text-center table-sm" style="background-color: #FDFDFD;">
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{__('public.'. $item['month_name'])}}</td>
                                            <td style="font-style: italic;">{{number_format($item['total'],3)}} {{__('public.OMR')}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-danger ">{{__('public.totalAll')}}</td>
                                        <td class="text-danger ">{{number_format($total, 3)}} {{__('public.OMR')}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <canvas id="allYears"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        Chart.register(ChartDataLabels);
        const plugin = {
            id: 'customCanvasBackgroundColor',
            beforeDraw: (chart, args, options) => {
                const {
                    ctx
                } = chart;
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = options.color || '#FDFDFD';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            },
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
                datalabels: {
                    clamp: true,
                    anchor: 'end',
                    align: 'center',
                    formatter: Math.round,
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                }
            }
        };
        Chart.defaults.font.family = 'monadi';
        Chart.defaults.font.size = 16;
        const allTimeData = {!!$allYears!!};
        const thisTimeData = {!!$currentYear!!};
        const all = document.getElementById('allYears');
        new Chart(all, {
            type: 'line',
            data: allTimeData,
            options: option,
            plugins: [plugin],
        });
        const current = document.getElementById('thisYear');
        new Chart(current, {
            type: 'line',
            data: thisTimeData,
            options: option,
            plugins: [plugin],
        });
    </script>


</div>
