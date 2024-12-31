<div>
    <div class="container bg-white">
        <div class="row">
            <div class="col-md-12 text-center">
                @if($settings->header)
                    <img src="{{asset($settings->header)}}" width="100%" height="100px" alt="">
                @else
                    @if($settings->logo)
                        <img src="{{asset($settings->logo)}}" width="80" height="80" alt="">
                    @else
                        <img src="{{asset('images/logo.png')}}" width="80" height="80" alt="">
                    @endif
                @endif
                <br>
                <br>
                <h3 class="text-center">{{__('public.receiptPaymentPrint')}} - {{__('public.receipt')}}</h3>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintDate')}}
                        </td>
                        <td class="text-center">
                            {{date('Y-m-d', strtotime($purchasePayment->date))}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintNumber')}}
                        </td>
                        <td class="text-center">
                            {{$purchasePayment->id}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintTax')}}
                        </td>
                        <td class="text-center">
                            {{$purchasePayment->purchase->tax}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintInvoice')}}
                        </td>
                        <td class="text-center">
                            {{$purchasePayment->purchase->id}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-sm text-center">
                    <tr>
                        <td class="bg-light">صرفنا إلى المورد الفاضل</td>
                        <td>{{$purchasePayment->purchase->supplier->name}}</td>
                        <td class="bg-light">we paid from</td>
                    </tr>
                    <tr>
                        <td class="bg-light">رقم فاتورة الشراء</td>
                        <td>{{$purchasePayment->purchase->id}}</td>
                        <td class="bg-light">Car No. And Type</td>
                    </tr>
                    <tr>
                        <td class="bg-light">مبلغ وقدره</td>
                        <td>{{$purchasePayment->amount}}</td>
                        <td class="bg-light">Amount of</td>
                    </tr>
                    <tr>
                        <td class="bg-light">طريقة الدفع</td>
                        <td>{{$purchasePayment->payment->arName}} / {{$purchasePayment->payment->enName}}</td>
                        <td class="bg-light">Payment method</td>
                    </tr>
                    <tr>
                        <td class="bg-light">رقم الشيك</td>
                        <td>{{$purchasePayment->check}}</td>
                        <td class="bg-light">Check Number</td>
                    </tr>
                    <tr>
                        <td class="bg-light">البيان</td>
                        <td>{{$purchasePayment->about}}</td>
                        <td class="bg-light">That's about</td>
                    </tr>
                    <tr>
                        <td class="bg-light">المبلغ الباقي</td>
                        <td>{{$purchasePayment->remine}}</td>
                        <td class="bg-light">The remaining amount</td>
                    </tr>
                </table>
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
            <div class="col-md-12">
                <div class="float-right m-1">
                    <a id="printPageButton" href="javascript:window.print()"
                       class="btn btn-dark m-2 waves-effect waves-light"><i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
