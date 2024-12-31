<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.quotations") }} - {{$quotations->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_SHOW_CARS)
                            <a href="{{route('add-quotation-to-car')}}" class="btn btn-dark m-2">
                                {{ __('public.add') }} {{ __('public.quotations') }}
                            </a>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <label for="search"></label><input wire:model.debounce.500ms="search" class="form-control"
                                                           type="search" name="search" id="search"
                                                           placeholder="{{ __('public.search') }}"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.number") }} {{ __("public.theInvoice") }}</td>
                            <td>{{ __("public.customerName") }} <br>{{__('public.customerPhone')}}</td>
                            <td>{{ __("public.vehicles") }}</td>
                            <td>{{ __("public.vehicleNumber") }} <br>{{ __("public.carColor") }} <br>{{
                                    __("public.manufacturingYear") }}</td>
                            <td>{{ __("public.totalAll") }}</td>
                            <td>{{ __("public.discount") }}</td>
                            <td>{{ __("public.amountIncludeDiscount") }}</td>
                            <td>{{ __("public.taxAmount") }}</td>
                            <td>{{ __("public.totalAmount") }} <br> OMR</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($quotations as $quotation)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$quotation->id}}
                                    </td>
                                    <td>{{$quotation->car->customer->name}} <br>{{$quotation->car->customer->phone}}
                                    </td>
                                    <td>
                                        {{app()->getLocale()=='ar' ? $quotation->car->brand->arName : $quotation->car->brand->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $quotation->car->model->arName : $quotation->car->model->enName}}
                                        <br>
                                        {{app()->getLocale()=='ar' ? $quotation->car->type->arName : $quotation->car->type->enName}}
                                    </td>
                                    <td>{{$quotation->car->number}} <br>{{$quotation->car->color}}
                                        <br>{{$quotation->car->year}}
                                    </td>
                                    <td>
                                        {{number_format((($quotation->services_total ?? 0) + ($quotation->parts_total ?? 0)),3)}}
                                    </td>
                                    <td>
                                        {{number_format($quotation->discount,3)}}
                                    </td>
                                    <td>
                                        {{number_format((($quotation->services_total ?? 0) + ($quotation->parts_total ?? 0) - $quotation->discount),3)}}
                                    </td>
                                    <td>
                                        {{$quotation->tax}}%
                                    </td>
                                    <td>
                                        {{number_format($quotation->total,3)}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($quotation->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_QUOTATIONS)
                                            <a href="{{route('quotations-print', $quotation->id)}}"
                                               class="btn btn-outline-secondary btn-sm rounded-3">
                                                <span class="fas fa-print"></span>
                                                {{__('public.print')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_QUOTATIONS)
                                            <a href="{{route('edit-quotation', $quotation->id)}}"
                                               class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_QUOTATIONS)
                                            <a href="{{route('quotations-view', $quotation->id)}}"
                                               class="btn btn-outline-dark btn-sm rounded-3">
                                                <span class="fas fa-eye"></span>
                                                {{__('public.view')}}
                                            </a>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_QUOTATIONS)
                                            <button
                                                wire:click="remove({{$quotation->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$quotation->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $quotations->links() }}
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
