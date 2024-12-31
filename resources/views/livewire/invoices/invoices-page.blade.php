<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.invoices") }} - {{$invoices->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_SHOW_CARS)
                            <a href="{{route('add-invoice-to-car')}}" class="btn btn-dark m-2">
                                {{ __('public.add') }} {{ __('public.invoices') }}
                            </a>
                        @endcan
                        <br>
                        <select class="form-select" aria-label="filter" wire:model="isPaid">
                            <option value="all">{{__('public.allInvoices')}}</option>
                            <option value="true">{{__('public.paidInvoices')}}</option>
                            <option value="false">{{__('public.unPaidInvoices')}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input wire:model.debounce.500ms="search" class="form-control"
                               type="search" name="search" id="search"
                               placeholder="{{ __('public.search') }}"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive">
                        <h6 class="text-center text-danger">
                            @if($isPaid=='true')
                                *{{__('public.note:paidInvoicesFilterApplied')}}
                            @elseif($isPaid=='false')
                                *{{__('public.note:unPaidInvoicesFilterApplied')}}
                            @else
                                *{{__('public.note:allInvoicesFilterApplied')}}
                            @endif
                        </h6>
                        <table class="table table-bordered table-sm">
                            <thead class="text-center align-middle">
                            <tr>
                                <th class="text-primary bg-body-tertiary">#</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.number") }} {{ __("public.theInvoice") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.jobCardNumber") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.customerName") }}
                                    <br>{{__('public.customerPhone')}}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.vehicles") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.vehicleNumber") }}
                                    <br>{{ __("public.carColor") }} <br>{{
                                    __("public.manufacturingYear") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.totalAll") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.discount") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.amountIncludeDiscount") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.taxAmount") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.totalAmount") }} <br> OMR</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.paid") }} <br> OMR</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.restAmount") }} <br> OMR</th>
                                <th class="text-primary bg-body-tertiary text-center">
                                    {{ __("public.isPaid") }}
                                </th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.createdAt") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.action") }}</th>
                                <th class="text-primary bg-body-tertiary">{{ __("public.user") }}</th>
                            </tr>
                            </thead>
                            @foreach($invoices as $invoice)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$invoice->id}}
                                    </td>
                                    <td>{{$invoice->job->id ?? '####'}}</td>
                                    <td>{{$invoice->car->customer->name}} <br>{{$invoice->car->customer->phone}}</td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $invoice->car->brand->arName : $invoice->car->brand->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $invoice->car->model->arName : $invoice->car->model->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $invoice->car->type->arName : $invoice->car->type->enName}}
                                    </td>
                                    <td>{{$invoice->car->number}} <br>{{$invoice->car->color}}
                                        <br>{{$invoice->car->year}}
                                    </td>
                                    <td>
                                        {{number_format((($invoice->services_total ?? 0) + ($invoice->parts_total ?? 0)),3)}}
                                    </td>
                                    <td>
                                        {{number_format($invoice->discount,3)}}
                                    </td>
                                    <td>
                                        {{number_format((($invoice->services_total ?? 0) + ($invoice->parts_total ?? 0) - $invoice->discount),3)}}
                                    </td>
                                    <td>
                                        {{$invoice->tax}}%
                                    </td>
                                    <td>
                                        <span @class([
                                    'warning-card' => ($invoice->total ?? 0) > 0,
                                    'dark-card' => ($invoice->total ?? 0) == 0,
                                    'danger-card' => ($invoice->total ?? 0) < 0,
                                ])>
                                            {{number_format($invoice->total,3)}}
                                        </span>

                                    </td>
                                    <td>
                                        <span @class([
                                    'success-card' => ($invoice->payments_sum_amount ?? 0) > 0,
                                    'dark-card' => ($invoice->payments_sum_amount ?? 0) == 0,
                                    'danger-card' => ($invoice->payments_sum_amount ?? 0) < 0,
                                ])>
                                        {{number_format($invoice->payments_sum_amount,3) ?? 0}}
                                        </span>
                                    </td>
                                    <td>
                                        <span @class([
                                    'success-card' => ($invoice->total-$invoice->payments_sum_amount ?? 0) < 0,
                                    'dark-card' => ($invoice->total-$invoice->payments_sum_amount ?? 0) == 0,
                                    'danger-card' => ($invoice->total-$invoice->payments_sum_amount ?? 0) > 0,
                                ])>
                                        {{number_format(($invoice->total-$invoice->payments_sum_amount),3) ?? 0}}
                                        </span>
                                    </td>
                                    <td>
                                        <span @class([
                                    'success-card' => $invoice->is_paid,
                                    'danger-card' => !$invoice->is_paid,
                                                    ])>
                                        <i @class([
                                    'fas fa-check' => $invoice->is_paid,
                                    'fas fa-times' => !$invoice->is_paid,
                                                    ])>
                                        </i>
                                        </span>

                                    </td>
                                    <td>
                                        <span class="dark-card">
                                            {{date('Y-m-d', strtotime($invoice->created_at))}}
                                        </span>
                                    </td>
                                    @if($invoice->trashed())
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <span class="danger-card">
                                               {{__('public.deletedBy')}} {{$invoice->user->name ?? trans('public.not-available')}}
                                            </span>
                                                <button class="btn btn-success btn-sm rounded-3"
                                                        wire:click="restore({{$invoice->id}})">
                                                    {{__('public.restore')}}
                                                </button>
                                                <button class="btn btn-danger btn-sm rounded-3"
                                                        wire:click="forceDelete({{$invoice->id}})">
                                                    {{__('public.delete')}}
                                                </button>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            @can(\App\Enums\AppPermissions::CAN_CREATE_INVOICE_PAYMENTS)
                                                <a href="{{route('invoices-add-payment',$invoice->id)}}"
                                                   class="btn btn-outline-success btn-sm rounded-3">
                                                    <span class="fas fa-dollar-sign"></span>
                                                    {{__('public.payments')}}
                                                </a>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_SHOW_INVOICES)
                                                <a href="{{route('invoices-view',$invoice->id)}}"
                                                   class="btn btn-outline-dark btn-sm rounded-3">
                                                    <span class="fas fa-eye"></span>
                                                    {{__('public.view')}}
                                                </a>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_SHOW_INVOICES)
                                                <button
                                                    wire:click="share(['{{ $invoice->car->customer->phone }}', '{{ $invoice->uuid }}'])"
                                                    class="btn btn-outline-info btn-sm rounded-3">
                                                    <span class="fas fa-share"></span>
                                                    {{ __('public.share') }}
                                                </button>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_EDIT_INVOICES)
                                                @if(isset($invoice->job->id))
                                                    <a href="{{route('edit-invoice',$invoice->id)}}"
                                                       class="btn btn-outline-primary btn-sm rounded-3">
                                                        <span class="fas fa-edit"></span>
                                                        {{__('public.edit')}}
                                                    </a>
                                                @endif
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_DELETE_INVOICES)
                                                <button
                                                    wire:click="remove({{$invoice->id}})"
                                                    class="btn btn-outline-danger btn-sm rounded-3">
                                                    <span class="fas fa-trash"></span>
                                                    {{__('public.delete')}}
                                                </button>
                                            @endcan
                                        </td>
                                    @endif

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

    <x-modal id="shareModal" title="public.share" background="bg-info">
        <div class="text-center">
            <a href="{{$urlInvoiceWithDetails}}" target="_blank"
               class="btn btn-primary  rounded-3">
                <span class="fas fa-share"></span>
                {{__('public.shareWithDetails')}}
            </a>
            <a href="{{$urlInvoiceWithoutDetails}}" target="_blank"
               class="btn btn-dark m-2  rounded-3">
                <span class="fas fa-share"></span>
                {{__('public.shareWithoutDetails')}}
            </a>
        </div>
    </x-modal>

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
        window.addEventListener('show-share-model', event => {
            $('#shareModal').modal('show');
        })
        window.addEventListener('hide-share-model', event => {
            $('#shareModal').modal('hide');
        })
    </script>
</div>
