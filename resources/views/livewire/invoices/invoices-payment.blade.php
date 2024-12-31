<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.paymentsInvoices") }} - {{$invoices->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_SHOW_INVOICES)
                            <a href="{{route('invoices')}}" class="btn btn-dark m-2">
                                {{ __('public.add') }} {{ __('public.paymentsInvoices') }}
                            </a>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.receiptNo") }}</td>
                            <td>{{ __("public.customerName") }}</td>
                            <td>{{ __("public.customerPhone") }}</td>
                            <td>{{ __("public.number") }} {{ __("public.theInvoice") }}</td>
                            <td>{{ __("public.receiptDate") }}</td>
                            <td>{{ __("public.amount") }}</td>
                            <td>{{ __("public.receiptPrint") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($invoices as $invoice)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$invoice->id}}
                                    </td>
                                    <td>{{$invoice->invoice->customer->name}}</td>
                                    <td>{{$invoice->invoice->customer->phone}}</td>
                                    <td>
                                        {{$invoice->invoice->id}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($invoice->date))}}
                                    </td>
                                    <td>
                                        <span class="success-card">{{number_format($invoice->amount,3)}}</span>
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_INVOICE_PAYMENTS)
                                            <a href="{{route('invoices-print-payment',$invoice->id)}}"
                                               class="btn btn-outline-secondary btn-sm rounded-3">
                                                <span class="fas fa-print"></span>
                                                {{__('public.print')}}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        {{$invoice->created_at}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_INVOICE_PAYMENTS)
                                            <button
                                                wire:click="remove({{$invoice->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$invoice->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>

    <x-modal id="dangerModal" title="public.delete" background="bg-danger">
        <div class="text-center">
            {{__('public.sure')}}
            <br>
            <button class="btn btn-danger text-white" wire:click="delete"
                    type="button">{{__('public.delete')}}</button>
        </div>
    </x-modal>

    <script>
        window.addEventListener('show-delete-model', event => {
            $('#dangerModal').modal('show');
        })
        window.addEventListener('hide-delete-model', event => {
            $('#dangerModal').modal('hide');
        })
    </script>
</div>
