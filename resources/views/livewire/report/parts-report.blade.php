<div>
    <div class="container">
        <h3 class="text-center mb-5 text-danger">{{__('public.parts-report')}}</h3>
        <table class="table table-bordered align-middle text-center table-sm" style="background-color: #FDFDFD;">
            <thead>
            <tr>
                <th class="fw-bold text-danger">{{__('public.month')}}</th>
                <th class="fw-bold text-danger">{{__('public.total-quantity')}}</th>
                <th class="fw-bold text-danger">
                    {{__('public.total-sales')}}
                    <br>
                    ({{__('public.sale_price')}})
                </th>
                <th class="fw-bold text-danger">
                    {{__('public.total-purchases')}}
                    <br>
                    ({{__('public.purchase_price')}})
                </th>
                <th class="fw-bold text-danger">{{__('public.revenue-difference')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($monthlyFinancials as $data)
                <tr>
                    <td>{{ $data['month'] }}</td>
                    <td>{{ $data['totalQuantity'] }}</td>
                    <td>
                        <span class="{{ $data['totalSales'] > 0 ? 'success-card' : '' }}">
                            {{ number_format($data['totalSales'], 3) }} {{ __('public.OMR') }}
                        </span>
                    </td>
                    <td>
                         <span class="{{ $data['totalPurchases'] > 0 ? 'danger-card' : '' }}">
                             {{ number_format($data['totalPurchases'], 3) }} {{__('public.OMR')}}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $data['revenueDifference'] > 0 ? 'info-card' : '' }}">
                             {{ number_format($data['revenueDifference'], 3) }} {{__('public.OMR')}}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
