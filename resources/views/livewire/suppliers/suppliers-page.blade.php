<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.suppliers") }} - {{$suppliers->total()}}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_SUPPLIERS)
                            <button class="btn btn-dark m-2" wire:click="add"
                            >
                                {{ __('public.add') }} {{ __('public.supplier') }}
                            </button>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="col-md-12 mt-3 table-responsive" wire:ignore.self>
                        <table class="table   table-bordered table-sm">
                            <thead class=" text-center text-danger align-middle">
                            <td>#</td>
                            <td>{{ __("public.name") }}</td>
                            <td>{{ __("public.customerPhone") }}</td>
                            <td>{{ __("public.customerEmail") }}</td>
                            <td>{{ __("public.customerAddress") }}</td>
                            <td>{{ __("public.numberInvoices") }}</td>
                            <td>{{ __("public.totalAmount") }} <br> OMR</td>
                            <td>{{ __("public.paid") }} <br> OMR</td>
                            <td>{{ __("public.restAmount") }} <br> OMR</td>
                            <td>{{ __("public.createdAt") }}</td>
                            <td>{{ __("public.action") }}</td>
                            <td>{{ __("public.user") }}</td>
                            </thead>
                            @foreach($suppliers as $supplier)
                                <tr class="text-center table-font align-middle">
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$supplier->name}}
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="https://wa.me/{{$supplier->phone}}" target="_blank">
                                            {{$supplier->phone}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-decoration-none text-primary"
                                           href="mailto:{{$supplier->email}}">{{$supplier->email}}</a>
                                    </td>
                                    <td>
                                        {{$supplier->address}}
                                    </td>
                                    <td>
                                        {{ $supplier->purchases_count }}
                                    </td>
                                    <td>
                                        {{number_format($supplier->purchases_sum_total,3)}}
                                    </td>
                                    <td>
                                        {{number_format($supplier->payments_sum_amount,3)}}
                                    </td>
                                    <td>
                                        {{number_format($supplier->purchases_sum_total - $supplier->payments_sum_amount,3)}}
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($supplier->created_at))}}
                                    </td>
                                    <td>
                                        @can(\App\Enums\AppPermissions::CAN_EDIT_SUPPLIERS)
                                            <button
                                                wire:click="update({{$supplier->id}})"
                                                class="btn btn-outline-primary btn-sm rounded-3">
                                                <span class="fas fa-edit"></span>
                                                {{__('public.edit')}}
                                            </button>
                                        @endcan
                                        @can(\App\Enums\AppPermissions::CAN_DELETE_SUPPLIERS)
                                            <button
                                                wire:click="remove({{$supplier->id}})"
                                                class="btn btn-outline-danger btn-sm rounded-3">
                                                <span class="fas fa-trash"></span>
                                                {{__('public.delete')}}
                                            </button>
                                        @endcan
                                    </td>
                                    <td>
                                    <span class="dark-card">
                                        {{$supplier->user->name ?? trans('public.not-available')}}
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $suppliers->links() }}
            </div>
        </div>

        <x-modal id="createModal" title="public.add" background="bg-dark">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="customerName" class="form-label mt-2">{{ __("public.name") }}*</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="customerName"
                               required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label mt-2">{{ __("public.customerPhone") }}*</label>
                        <input wire:model.defer="phone" type="text" class="form-control" id="phone"
                               required>
                        @error('phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label mt-2">{{ __("public.customerEmail") }}</label>
                        <input wire:model.defer="email" type="text" class="form-control" id="email">
                        @error('email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address"
                               class="form-label mt-2">{{ __("public.customerAddress") }}</label>
                        <input wire:model.defer="address" type="text" class="form-control" id="address">
                        @error('address') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note") }}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control"
                                  id="notes"></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                    </div>
                </div>
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

        <x-modal id="editModal" title="public.edit" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="customerName" class="form-label mt-2">{{ __("public.customerName") }}
                            *</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="customerName"
                               required>
                        @error('name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerPhone" class="form-label mt-2">{{ __("public.customerPhone") }}
                            *</label>
                        <input wire:model.defer="phone" type="text" class="form-control" id="customerPhone"
                               required>
                        @error('phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerEmail"
                               class="form-label mt-2">{{ __("public.customerEmail") }}</label>
                        <input wire:model.defer="email" type="text" class="form-control" id="customerEmail">
                        @error('email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerAddress"
                               class="form-label mt-2">{{ __("public.customerAddress") }}</label>
                        <input wire:model.defer="address" type="text" class="form-control"
                               id="customerAddress">
                        @error('address') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.note") }}</label>
                        <textarea wire:model.defer="notes" type="text" class="form-control"
                                  id="notes"></textarea>
                        @error('notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary"
                                wire:click="updateCustomer">{{__('public.save')}}</button>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
    <script>
        window.addEventListener('show-delete-model', event => {
            $('#dangerModal').modal('show');
        })
        window.addEventListener('hide-delete-model', event => {
            $('#dangerModal').modal('hide');
        })
        window.addEventListener('show-edit-model', event => {
            $('#editModal').modal('show');
        })
        window.addEventListener('hide-edit-model', event => {
            $('#editModal').modal('hide');
        })
        window.addEventListener('show-create-model', event => {
            $('#createModal').modal('show');
        })
        window.addEventListener('hide-create-model', event => {
            $('#createModal').modal('hide');
        })
    </script>
</div>
