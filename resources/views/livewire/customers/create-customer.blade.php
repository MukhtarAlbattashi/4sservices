<div>
    <x-loading-component wireTarget="save"/>
    <button class="btn btn-dark m-2" x-data @click="$dispatch('show-create-model')">
        {{ __('public.addNewCustomer') }}
    </button>
    <x-modal id="createModal" title="public.addNewCustomer" background="bg-dark">
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="customerName" class="form-label mt-2">{{ __("public.customerName") }}
                        *</label>
                    <input wire:model.defer="customer.name" type="text" class="form-control" id="customerName"
                           required>
                    @error('customer.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerPhone" class="form-label mt-2">{{ __("public.customerPhone") }}
                        *</label>
                    <input wire:model.defer="customer.phone" type="text" class="form-control" id="customerPhone"
                           required>
                    @error('customer.phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerEmail"
                           class="form-label mt-2">{{ __("public.customerEmail") }}</label>
                    <input wire:model.defer="customer.email" type="text" class="form-control" id="customerEmail">
                    @error('customer.email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerTax" class="form-label mt-2">{{ __("public.taxno") }}</label>
                    <input wire:model.defer="customer.tax_no" type="text" class="form-control" id="customerTax">
                    @error('customer.tax_no') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerAddress"
                           class="form-label mt-2">{{ __("public.customerAddress") }}</label>
                    <input wire:model.defer="customer.address" type="text" class="form-control"
                           id="customerAddress">
                    @error('customer.address') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerNationality"
                           class="form-label mt-2">{{ __("public.customerNationality") }}</label>
                    <input wire:model.defer="customer.nationality" type="text" class="form-control"
                           id="customerNationality">
                    @error('customer.nationality') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label for="customerIdentity"
                           class="form-label mt-2">{{ __("public.customerIdentity") }}</label>
                    <input wire:model.defer="customer.identity" type="text" class="form-control"
                           id="customerIdentity">
                    @error('customer.identity') <span
                        class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12">
                    <label for="customerIdentity"
                           class="form-label mt-2">{{ __("public.note") }}</label>
                    <textarea wire:model.defer="customer.note" type="text" class="form-control"
                              id="customerIdentity"></textarea>
                    @error('customer.note') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-success" wire:click="save">{{__('public.save')}}</button>
                </div>
            </div>
        </div>
    </x-modal>
    <script>
        window.addEventListener('show-create-model', event => {
            $('#createModal').modal('show');
        })
        window.addEventListener('hide-create-model', event => {
            $('#createModal').modal('hide');
        })
    </script>
</div>
