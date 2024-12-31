<div>
    <div class="container-fluid px-5">
        <x-loading-component wireTarget="updateCustomer"/>
        <x-loading-component wireTarget="update"/>
        <x-loading-component wireTarget="delete"/>
        <x-loading-component wireTarget="search"/>

        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.customers") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        @can(\App\Enums\AppPermissions::CAN_CREATE_CUSTOMERS)
                            <livewire:customers.create-customer/>
                        @endcan
                    </div>
                    <div class="col-md-3">
                        <x-search-component wireModel="search"/>
                    </div>
                    <div class="d-none d-lg-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="text-center align-middle">
                                <tr>
                                    <th class="text-primary bg-body-tertiary">{{__('#')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.customerName')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.customerPhone')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.customerEmail')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.numberOfCars')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.numberInvoices')}}</th>
                                    @can(\App\Enums\AppPermissions::CAN_SHOW_CARS_REPORT)
                                        <th class="text-primary bg-body-tertiary">{{__('public.totalAmount')}}</th>
                                        <th class="text-primary bg-body-tertiary">{{__('public.paid')}}</th>
                                        <th class="text-primary bg-body-tertiary">{{__('public.restAmount')}}</th>
                                    @endcan
                                    <th class="text-primary bg-body-tertiary">{{__('public.createdAt')}}</th>
                                    <th class="text-primary bg-body-tertiary">{{__('public.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customers as $customer)
                                    <tr class="text-center table-font align-middle">
                                        <td>
                                            {{$customers->firstItem()+$loop->index}}
                                        </td>
                                        <td>
                                            {{$customer->name}}
                                        </td>
                                        <td>
                                            <a class="text-decoration-none text-info"
                                               href="https://wa.me/{{$customer->phone}}">
                                                {{$customer->phone}}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="text-decoration-none text-info"
                                               href="mailto:{{$customer->email}}">{{$customer->email}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="dark-card">
                                                {{ $customer->cars_count }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="dark-card">
                                                {{ $customer->invoices_count }}
                                            </span>
                                        </td>
                                        @can(\App\Enums\AppPermissions::CAN_SHOW_CARS_REPORT)
                                            <td>
                                                <x-text-with-background :number="$customer->invoices_sum_total"
                                                                        state="invoices_sum_total"/>
                                            </td>
                                            <td>
                                                <x-text-with-background :number="$customer->payments_sum_amount"
                                                                        state="payments_sum_amount"/>
                                            </td>
                                            <td>
                                                <x-text-with-background :number="$customer->remaining_payments"
                                                                        state="remaining_payments"/>
                                            </td>
                                        @endcan
                                        <td>
                                            <span class="dark-card">
                                                {{$customer->created_at->diffForHumans()}}
                                            </span>
                                        </td>
                                        <td class="d-flex justify-content-center gap-3">
                                            @can(\App\Enums\AppPermissions::CAN_CREATE_CARS)
                                                <button
                                                    wire:click="createNewCarForCustomer({{$customer->id}})"
                                                    class="btn btn-outline-dark btn-sm rounded-3">
                                                    <span class="fas fa-car"></span>
                                                    {{__('public.addNewCar')}}
                                                </button>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_EDIT_CUSTOMERS)
                                                <button
                                                    wire:click="update({{$customer->id}})"
                                                    class="btn btn-outline-primary btn-sm rounded-3">
                                                    <span class="fas fa-edit"></span>
                                                    {{__('public.edit')}}
                                                </button>
                                            @endcan
                                            @can(\App\Enums\AppPermissions::CAN_DELETE_CUSTOMERS)
                                                <button
                                                    x-data
                                                    @click="$wire.set('customerId', {{$customer->id}}, true); $dispatch('show-delete-model')"
                                                    class="btn btn-outline-danger btn-sm rounded-3">
                                                    <span class="fas fa-trash"></span>
                                                    {{__('public.delete')}}
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">
                                            <h6 class="text-center text-danger">{{__('public.noData')}}</h6>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-lg-none">
                        <div class="container-fluid mt-3 p-0 m-0">
                            <div class="row">
                                @foreach($customers as $customer)
                                    <x-mobile-card :customer="$customer"/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $customers->links() }}
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

        <x-modal id="editModal" title="public.edit" background="bg-primary">
            <div class="container-fluid my-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="customerName" class="form-label mt-2">{{ __("public.customerName") }}
                            *</label>
                        <input wire:model.defer="editCustomer.name" type="text" class="form-control" id="customerName"
                               required>
                        @error('editCustomer.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerPhone" class="form-label mt-2">{{ __("public.customerPhone") }}
                            *</label>
                        <input wire:model.defer="editCustomer.phone" type="text" class="form-control" id="customerPhone"
                               required>
                        @error('editCustomer.phone') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerEmail"
                               class="form-label mt-2">{{ __("public.customerEmail") }}</label>
                        <input wire:model.defer="editCustomer.email" type="text" class="form-control"
                               id="customerEmail">
                        @error('editCustomer.email') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerTax" class="form-label mt-2">{{ __("public.taxno") }}</label>
                        <input wire:model.defer="editCustomer.tax_no" type="text" class="form-control" id="customerTax">
                        @error('editCustomer.tax_no') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerAddress"
                               class="form-label mt-2">{{ __("public.customerAddress") }}</label>
                        <input wire:model.defer="editCustomer.address" type="text" class="form-control"
                               id="customerAddress">
                        @error('editCustomer.address') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerNationality"
                               class="form-label mt-2">{{ __("public.customerNationality") }}</label>
                        <input wire:model.defer="editCustomer.nationality" type="text" class="form-control"
                               id="customerNationality">
                        @error('editCustomer.nationality') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="customerIdentity"
                               class="form-label mt-2">{{ __("public.customerIdentity") }}</label>
                        <input wire:model.defer="editCustomer.identity" type="text" class="form-control"
                               id="customerIdentity">
                        @error('editCustomer.identity') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="customerIdentity"
                               class="form-label mt-2">{{ __("public.note") }}</label>
                        <textarea wire:model.defer="editCustomer.note" type="text" class="form-control"
                                  id="customerIdentity"></textarea>
                        @error('editCustomer.note') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
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
    </script>
</div>
