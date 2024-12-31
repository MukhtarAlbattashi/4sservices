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
                    <div class="col-md-12 text-center mb-2">
                        @if($settings->header)
                            <img src="{{asset($settings->header)}}" width="100%" height="100px" alt="">
                        @else
                            @if($settings->logo)
                                <img src="{{asset($settings->logo)}}" width="80" height="80" alt="">
                            @else
                                <img src="{{asset('images/logo.png')}}" width="80" height="80" alt="">
                            @endif
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if(isset($invoiceView))
                            @livewire('invoices.car-info-page', ['car' => $invoiceView->car])
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
                        <div class="text-center">
                            <p>{{__('public.stamp')}}</p>
                            @if($settings->stamp)
                                <img src="{{asset($settings->stamp)}}" width="100%" height="100px" alt="">
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
