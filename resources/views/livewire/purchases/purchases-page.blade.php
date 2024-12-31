<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.purchases") }} - {{$purchases->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_PURCHASES)
                            <a href="{{route('add-purchases')}}" class="btn btn-dark m-2">
                                {{ __('public.purchases') }}
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
                            <td>{{ __("public.number") }} {{ __("public.theInvoice") }}</td>
                            <td>{{ __("public.supplierName") }}</td>
                            <td>{{ __("public.customerPhone") }}</td>
                            <td>{{ __("public.sub-total") }} <br> OMR</td>
                            <td>{{ __("public.taxAmount") }}</td>
                            <td>{{ __("public.discount") }}</td>
                            <td>{{ __("public.totalAmount") }} <br> OMR</td>
                            <td>{{ __("public.paid") }} <br> OMR</td>
                            <td>{{ __("public.restAmount") }} <br> OMR</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
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
                                        {{$purchase->supplier->name}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="https://wa.me/{{$purchase->supplier->phone}}" target="_blank">
                                            {{$purchase->supplier->phone}}
                                        </a>
                                    </td>
                                    <td>
                                        {{number_format($purchase->sub_total,3)}}
                                    </td>
                                    <td>
                                        {{$purchase->tax}}
                                    </td>
                                    <td>
                                        {{number_format($purchase->discount,3)}}
                                    </td>
                                    <td>
                                        {{number_format($purchase->total,3)}}
                                    </td>
                                    <td>
                                        {{number_format($purchase->payments_sum_amount ?? 0,3)}}
                                    </td>
                                    <td>
                                        @if (($purchase->total - $purchase->payments_sum_amount) < 0)
                                            <span
                                                class="text-danger">{{number_format($purchase->total - $purchase->payments_sum_amount,3)}}</span>
                                        @else
                                            <span> {{number_format($purchase->total - $purchase->payments_sum_amount,3)}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($purchase->created_at))}}
                                    </td>
                                    @if($purchase->trashed())
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <span class="danger-card">
                                               {{__('public.deletedBy')}} {{$purchase->user->name ?? trans('public.not-available')}}
                                            </span>
                                                <button class="btn btn-success btn-sm rounded-3"
                                                        wire:click="restore({{$purchase->id}})">
                                                    {{__('public.restore')}}
                                                </button>
                                                <button class="btn btn-danger btn-sm rounded-3"
                                                        wire:click="forceDelete({{$purchase->id}})">
                                                    {{__('public.delete')}}
                                                </button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            @can(\App\Enums\AppPermissions::CAN_CREATE_PURCHASE_PAYMENTS)
                                                <a href="{{route('purchases-add-payment',$purchase->id)}}"
                                                   class="btn btn-outline-success btn-sm rounded-3">
                                                    <span class="fas fa-dollar-sign"></span>
                                                    {{__('public.payments')}}
                                                </a>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_EDIT_PURCHASES)
                                                <a href="{{route('purchases-edit',$purchase->id)}}"
                                                   class="btn btn-outline-primary btn-sm rounded-3">
                                                    <span class="fas fa-edit"></span>
                                                    {{__('public.edit')}}
                                                </a>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_SHOW_PURCHASES)
                                                <a href="{{route('purchases-view',$purchase->id)}}"
                                                   class="btn btn-outline-dark btn-sm rounded-3">
                                                    <span class="fas fa-eye"></span>
                                                    {{__('public.view')}}
                                                </a>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_DELETE_PURCHASES)
                                                <button
                                                    wire:click="remove({{$purchase->id}})"
                                                    class="btn btn-outline-danger btn-sm rounded-3">
                                                    <span class="fas fa-trash"></span>
                                                    {{__('public.delete')}}
                                                </button>
                                            @endcan
                                        </td>
                                    @endif
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
