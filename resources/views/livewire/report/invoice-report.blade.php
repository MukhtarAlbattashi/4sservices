<div>
    <div class="container">
        <h3 class="text-center mb-5 text-danger">{{__('public.invoicesReports')}}</h3>
        <table class="table table-bordered align-middle text-center table-sm" style="background-color: #FDFDFD;">
            <thead>
            <tr>
                <th class="fw-bold text-danger">
                    {{__('public.month')}}
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.total-invoices')}}
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.subTotalParts')}}
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.subTotalService')}}
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.subTotalBeforeSubtractingPartsPurchase')}}
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.diffBetweenPartsSalesAndPurchase')}}
                    <br>
                    ({{__('public.profits')}})
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.total')}} {{__('public.profits')}}
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ __(trans('public.' . $report['monthName'])) }}</td>
                    <td>{{ $report['total_invoices'] }}</td>
                    <td>
                        <span>
                            {{ number_format($report['total_parts'], 3) }} {{ __('public.OMR') }}
                        </span>
                    </td>
                    <td>
                         <span>
                             {{ number_format($report['total_services'], 3) }} {{__('public.OMR')}}
                        </span>
                    </td>
                    <td>
                        <span>
                             {{ number_format($report['total_invoice_amount'], 3) }} {{__('public.OMR')}}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $report['profitForParts'] > 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($report['profitForParts'], 3) }} {{ __('public.OMR') }}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $report['total_invoice_amount'] > 0 ? 'text-info' : '' }}">
                             {{ number_format($report['profitForParts']+$report['total_services'], 3) }} {{__('public.OMR')}}
                        </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>
                    <span class="fw-bold text-danger">{{__('public.total')}}</span>
                </td>
                <td colspan="6">
                    <span class="fw-bold text-danger">{{ number_format($totalProfits, 3) }} {{__('public.OMR')}}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
