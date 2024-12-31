<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.discounts") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="employee" class="form-label mt-2">{{ __("public.employees")}}*</label>
                        <select name="employee" wire:model.defer="employee" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getEmployees() as $item)
                                <option
                                    value="{{ $item->id }}">{{ app()->getLocale() == 'ar' ? $item->employeeNameAr : $item->employeeNameAr }}
                                    / {{$item->phone}}</option>
                            @endforeach
                        </select>
                        @error('employee') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="category" class="form-label mt-2">{{ __("public.sectionName")}}*</label>
                        <select name="category" wire:model.defer="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getCategories() as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}</label>
                        <input wire:model.defer="discount.name" type="text" class="form-control text-center" id="name"
                               required>
                        @error('discount.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}</label>
                        <input wire:model.defer="discount.amount" type="number" class="form-control text-center"
                               id="amount" required>
                        @error('discount.amount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label mt-2">{{ __("public.date")}}</label>
                        <input wire:model.defer="discount.date" type="date" class="form-control text-center" id="date"
                               required>
                        @error('discount.date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="discount.notes" type="text" class="form-control text-center"
                                  id="notes" required></textarea>
                        @error('discount.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    @can(\App\Enums\AppPermissions::CAN_CREATE_DISCOUNTS)
                        <button class="btn btn-success" wire:click="save">
                            {{ __('public.save') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
