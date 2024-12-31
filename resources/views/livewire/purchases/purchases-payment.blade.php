<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.paymentsPurchases") }} - {{$purchases->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_SHOW_PURCHASES)
                            <a href="{{route('purchases')}}" class="btn btn-dark m-2">
                                {{ __('public.add') }} {{ __('public.paymentsPurchases') }}
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
                            <td>{{ __("public.supplierName") }}</td>
                            <td>{{ __("public.customerPhone") }}</td>
                            <td>{{ __("public.number") }} {{ __("public.theInvoice") }}</td>
                            <td>{{ __("public.receiptDate") }}</td>
                            <td>{{ __("public.amount") }}</td>
                            <td>{{ __("public.receiptPrint") }}</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($purchases as $purchase)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$purchase->id}}
                                    </td>
                                    <td>
                                        {{$purchase->purchase->supplier->name}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="https://wa.me/{{$purchase->purchase->supplier->phone}}"
                                           target="_blank">
                                            {{$purchase->purchase->supplier->phone}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$purchase->purchase->id}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($purchase->date))}}
                                    </td>
                                    <td>
                                        {{$purchase->amount}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_PURCHASE_PAYMENTS)
                                            <a href="{{route('purchases-print-payment',$purchase->id)}}"
                                               class="btn btn-outline-secondary btn-sm rounded-3">
                                                <span class="fas fa-print"></span>
                                                {{__('public.print')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_PURCHASE_PAYMENTS)
                                            <button
                                                wire:click="remove({{$purchase->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                        {{$purchase->created_at}}
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$purchase->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $purchases->links() }}
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
