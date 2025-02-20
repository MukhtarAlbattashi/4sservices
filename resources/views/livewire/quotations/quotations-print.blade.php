<div>
    <div class="container-fluid bg-white" dir="rtl">
        <div class="row justify-content-between">
            <div class="col-md-12 col-sm-12 p-1">
                <h6>
                    لمحة للتجارة - Glance Trading
                </h6>
                <h6>
                    س.ت 1021863 - C.R NO 1021863
                </h6>
                <h6>
                    ولاية ينقل - سلطنة عمان - Wilayat Yanqul - S. of Oman
                </h6>
                <h6>
                    رقم الهاتف: 92040411 - Phone Number: 92040411

                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-2 text-center">
                <img src="{{asset('images/logo.png')}}" width="80" height="80" alt="">
                <br>
                <br>
                <h4 class="text-center">
                    {{__('public.quotations')}} {{$quotationView->id}}
                </h4>
            </div>
            <div class="col-md-12">
                @if(isset($quotationView))
                @livewire('invoices.car-info-page', ['car' => $quotationView->car])
                @endif
            </div>
            <div class="col-md-12">
                @if(isset($quotationView))
                <h3 class="text-right">{{__('public.details')}} {{__('public.parts')}}</h3>
                <table class="table table-bordered table-responsive table-sm text-center">
                    <tr class="bg-light text-danger ">
                        <td>#</td>
                        <td>{{ __("public.partName") }}</td>
                        <td>{{ __("public.price") }}</td>
                        <td>{{ __("public.quantity") }}/{{ __("public.liter") }}</td>
                        <td>{{ __("public.totalAmount") }}</td>
                    </tr>
                    @foreach($quotationView->parts as $part)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$part->arName}} / {{$part->enName}}</td>
                        <td>{{number_format($part->purchase_price,3)}}</td>
                        <td>{{$part->pivot->quantity}}</td>
                        <td>{{number_format($part->purchase_price * $part->pivot->quantity,3)}}</td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
            <div class="col-md-12">
                @if(isset($quotationView))
                <h3 class="text-right">{{__('public.details')}} {{__('public.services')}}</h3>
                <table class="table table-bordered table-responsive table-sm text-center">
                    <tr class="bg-light text-danger ">
                        <td>#</td>
                        <td>{{ __("public.partName") }}</td>
                        <td>{{ __("public.price") }}</td>
                        <td>{{ __("public.quantity") }}/{{ __("public.liter") }}</td>
                        <td>{{ __("public.totalAmount") }}</td>
                    </tr>
                    @foreach($quotationView->services as $service)
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
            </div>
            <div class="col-md-12">
                @if(isset($quotationView))
                <table class="table table-bordered table-responsive table-sm">
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.subTotalService") }}</td>
                        <td class="text-center">
                            {{number_format((($quotationView->services_total ?? 0)),3)}}
                        </td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.subTotalParts") }}</td>
                        <td class="text-center">{{number_format((($quotationView->parts_total ?? 0)),3)}}</td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.totalAll") }}</td>
                        <td class="text-center">
                            {{number_format((($quotationView->services_total ?? 0) + ($quotationView->parts_total ?? 0)),3)}}
                        </td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.discount") }}</td>
                        <td class="text-center">
                            {{number_format($quotationView->discount,3)}}
                        </td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.amountIncludeDiscount") }}</td>
                        <td class="text-center">
                            {{number_format((($quotationView->services_total ?? 0) + ($quotationView->parts_total ?? 0) - $quotationView->discount),3)}}
                        </td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.taxAmount") }}</td>
                        <td class="text-center">
                            {{number_format($quotationView->tax,3)}}
                        </td>
                    </tr>
                    <tr>
                        <td class=" text-primary bg-light">{{ __("public.totalAmount") }}</td>
                        <td class="text-center">{{number_format($quotationView->total,3)}}</td>
                    </tr>
                </table>
                @endif
            </div>
            <div class="col-md-12 d-flex justify-content-around mt-5">
                 <x-invoice-footer/>
            </div>
            <div class="col-md-12">
                <div class="float-right m-1">
                    <a id="printPageButton" href="javascript:window.print()" class="btn btn-dark m-2 waves-effect waves-light"><i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
