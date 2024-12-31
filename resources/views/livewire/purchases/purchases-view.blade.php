<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    {{__('public.invoiceDetailes')}} {{$purchaseView->id}}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($purchaseView))
                        <table class="table table-bordered table-responsive table-sm">
                            <tr>
                                <td class="bg-light text-danger">{{ __("public.supplierName") }}</td>
                                <td>
                                    {{$purchaseView->supplier->name}}
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light text-danger">{{ __("public.customerPhone") }}</td>
                                <td>{{$purchaseView->supplier->phone}}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                    <div class="col-md-12">
                        @if(isset($purchaseView))
                        <h3 class="text-right">{{__('public.details')}} {{__('public.parts')}}</h3>
                        <table class="table table-bordered table-responsive table-sm text-center">
                            <tr class="bg-light text-danger ">
                                <td>#</td>
                                <td>{{ __("public.partName") }}</td>
                                <td>{{ __("public.purchase_price") }}</td>
                                <td>{{ __("public.quantity") }}/{{ __("public.liter") }}</td>
                                <td>{{ __("public.totalAmount") }}</td>
                            </tr>
                            @foreach($purchaseView->parts as $part)
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
                        @if(isset($purchaseView))
                        <table class="table table-bordered table-responsive table-sm">
                            <tr>
                                <td class=" text-primary bg-light">{{ __("public.sub-total") }}</td>
                                <td class="text-center">
                                    {{number_format($purchaseView->sub_total,3)}}
                                </td>
                            </tr>
                            <tr>
                                <td class=" text-primary bg-light">{{ __("public.taxAmount") }}</td>
                                <td class="text-center">{{$purchaseView->tax}}</td>
                            </tr>
                            <tr>
                                <td class=" text-primary bg-light">{{ __("public.discount") }}</td>
                                <td class="text-center">{{$purchaseView->discount}}</td>
                            </tr>
                            <tr>
                                <td class=" text-primary bg-light">{{ __("public.totalAmount") }}</td>
                                <td class="text-center">{{number_format($purchaseView->total,3)}}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
