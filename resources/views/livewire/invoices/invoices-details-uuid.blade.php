<div>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h4>
                    {{__('public.invoiceDetailes')}} {{$invoiceView->id}} {{__('public.invoiceDetailes',[],'en')}}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-invoice-header/>
                    <div class="col-md-12">
                        @if(isset($invoiceView))
                            @livewire('invoices.car-info-page', ['car' => $invoiceView->car])
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if(isset($invoiceView))
                            @if(count($invoiceView->parts) > 0)

                            <h3 class="text-center">
                                <span>تفاصيل قطع الغيار</span>
                                -
                                <span>Parts Details</span>
                            </h3>
                            <table class="table table-bordered table-responsive table-sm text-center">
                                <tr class="bg-light text-danger ">
                                    <td>#</td>
                                    <td>{{ __("public.partName") }} - {{ __("public.partName",[],'en') }}</td>
                                    <td>{{ __("public.sale_price") }} - {{ __("public.sale_price",[],'en') }}</td>
                                    <td>{{ __("public.quantity") }}/{{ __("public.liter") }}
                                        - {{ __("public.quantity",[],'en') }}/{{ __("public.liter",[],'en') }}</td>
                                    <td>{{ __("public.totalAmount") }} - {{ __("public.totalAmount",[],'en') }}</td>
                                </tr>
                                @foreach($invoiceView->parts as $part)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$part->arName}} / {{$part->enName}}</td>
                                        <td>{{number_format($part->sale_price,3)}}</td>
                                        <td>{{$part->pivot->quantity}}</td>
                                        <td>{{number_format($part->sale_price * $part->pivot->quantity,3)}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if(isset($invoiceView))
                            @if(count($invoiceView->services) > 0)
                            <h3 class="text-center">
                                <span>تفاصيل الخدمات </span>
                                -
                                <span>Services Details</span>
                            </h3>
                            <table class="table table-bordered table-responsive table-sm text-center">
                                <tr class="bg-light text-danger ">
                                    <td>#</td>
                                    <td>{{ __("public.partName") }} - {{ __("public.partName",[],'en') }}</td>
                                    <td>{{ __("public.sale_price") }} - {{ __("public.sale_price",[],'en') }}</td>
                                    <td>{{ __("public.quantity") }}/{{ __("public.liter") }}
                                        - {{ __("public.quantity",[],'en') }}/{{ __("public.liter",[],'en') }}</td>
                                    <td>{{ __("public.totalAmount") }} - {{ __("public.totalAmount",[],'en') }}</td>
                                </tr>
                                @foreach($invoiceView->services as $service)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$service->arName}} / {{$service->enName}}</td>
                                        <td>{{number_format($service->amount,3)}}</td>
                                        <td>{{$service->pivot->quantity}}</td>
                                        <td>{{number_format($service->amount * $service->pivot->quantity,3)}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if(isset($invoiceView))
                            <table class="table table-bordered table-responsive table-sm">
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.date") }} - {{ __("public.date",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{date('Y-m-d',strtotime($invoiceView->date))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.subTotalService") }} - {{ __("public.subTotalService",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{number_format((($invoiceView->services_total ?? 0)),3)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.subTotalParts") }} - {{ __("public.subTotalParts",[],'en') }}
                                    </td>
                                    <td class="text-center">{{number_format((($invoiceView->parts_total ?? 0)),3)}}</td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.totalAll") }} - {{ __("public.totalAll",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{number_format((($invoiceView->services_total ?? 0) + ($invoiceView->parts_total ?? 0)),3)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.discount") }} - {{ __("public.discount",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{number_format($invoiceView->discount,3)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.amountIncludeDiscount") }} - {{ __("public.amountIncludeDiscount",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{number_format((($invoiceView->services_total ?? 0) + ($invoiceView->parts_total ?? 0) - $invoiceView->discount),3)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.taxAmount") }} - {{ __("public.taxAmount",[],'en') }}
                                    </td>
                                    <td class="text-center">
                                        {{$invoiceView->tax}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-primary bg-light">
                                        {{ __("public.totalAmount") }} - {{ __("public.totalAmount",[],'en') }}
                                    </td>
                                    <td class="text-center">{{number_format($invoiceView->total,3)}}</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <p>
                            {{__('public.note')}} : {{$invoiceView->notes}}
                        </p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-around mt-5">
                        <div class="text-center">
                            <p>{{__('public.signature')}}</p>
                            <span>-------------------------------</span>
                        </div>
                        <x-invoice-footer/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
