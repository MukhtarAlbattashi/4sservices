<div>
    <div class="container bg-white" dir="rtl">
        <div class="row">
            <div class="col-md-12 p-2 text-center">
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
                <h3 class="text-center">{{__('public.receiptVoucherPrint')}}</h3>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintDate')}}
                        </td>
                        <td class="text-center">
                            {{date('Y-m-d', strtotime($invoicePayments->date))}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintNumber')}}
                        </td>
                        <td class="text-center">
                            {{$invoicePayments->id}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintTax')}}
                        </td>
                        <td class="text-center">
                            {{$invoicePayments->invoice->tax}}
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintInvoice')}}
                        </td>
                        <td class="text-center">
                            {{$invoicePayments->invoice->id}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-sm text-center align-middle">
                    <tr>
                        <td class="bg-light">استلمنا من الفاضل</td>
                        <td>{{$invoicePayments->invoice->customer->name}}</td>
                        <td class="bg-light">we Received from</td>
                    </tr>
                    <tr>
                        <td class="bg-light">اسم المركبة ونوعها</td>
                        <td>
                            {{app()->getLocale()=='ar' ? $invoicePayments->invoice->car->brand->arName : $invoicePayments->invoice->car->brand->enName}}
                            /
                            {{app()->getLocale()=='ar' ? $invoicePayments->invoice->car->model->arName : $invoicePayments->invoice->car->model->enName}}
                            /
                            {{app()->getLocale()=='ar' ? $invoicePayments->invoice->car->type->arName : $invoicePayments->invoice->car->type->enName}}
                        </td>
                        <td class="bg-light">Vehicle Name</td>
                    </tr>
                    <tr>
                        <td class="bg-light">رقم المركبة ولونها وسنة الصنع</td>
                        <td>{{$invoicePayments->invoice->car->number}}/{{$invoicePayments->invoice->car->color}}
                            /{{$invoicePayments->invoice->car->year}}
                        </td>
                        <td class="bg-light">Vehicle No. And Type</td>
                    </tr>
                    <tr>
                        <td class="bg-light">مبلغ وقدره</td>
                        <td>{{number_format($invoicePayments->amount,3)}} OMR</td>
                        <td class="bg-light">Amount of</td>
                    </tr>
                    <tr>
                        <td class="bg-light">طريقة الدفع</td>
                        <td>{{$invoicePayments->payment->arName}} / {{$invoicePayments->payment->enName}}</td>
                        <td class="bg-light">Payment method</td>
                    </tr>
                    <tr>
                        <td class="bg-light">رقم الشيك</td>
                        <td>{{$invoicePayments->check}}</td>
                        <td class="bg-light">Check Number</td>
                    </tr>
                    <tr>
                        <td class="bg-light">البيان</td>
                        <td>{{$invoicePayments->about}}</td>
                        <td class="bg-light">That's about</td>
                    </tr>
                    <tr>
                        <td class="bg-light">المبلغ الباقي</td>
                        <td>{{number_format($invoicePayments->remine,3)}} OMR</td>
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
