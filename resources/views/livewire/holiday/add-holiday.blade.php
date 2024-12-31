<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.holidays") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="employee" class="form-label mt-2">{{ __("public.employees")}}*</label>
                        <select name="employee" wire:model.defer="employee" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
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
                        <input wire:model.defer="holiday.name" type="text" class="form-control text-center" id="name"
                               required>
                        @error('holiday.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}</label>
                        <input wire:model.defer="holiday.amount" type="number" class="form-control text-center"
                               id="amount" required>
                        @error('holiday.amount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="fromDate" class="form-label mt-2">{{ __("public.fromDate")}}</label>
                        <input wire:model.defer="holiday.fromDate" type="date" class="form-control text-center"
                               id="fromDate" required>
                        @error('holiday.fromDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="toDate" class="form-label mt-2">{{ __("public.toDate")}}</label>
                        <input wire:model.defer="holiday.toDate" type="date" class="form-control text-center"
                               id="toDate" required>
                        @error('holiday.toDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label mt-2">{{ __("public.date")}}</label>
                        <input wire:model.defer="holiday.date" type="date" class="form-control text-center" id="date"
                               required>
                        @error('holiday.date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="startDate" class="form-label mt-2">{{ __("public.startDate")}}</label>
                        <input wire:model.defer="holiday.startDate" type="date" class="form-control text-center"
                               id="startDate" required>
                        @error('holiday.startDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="employee" class="form-label mt-2">{{ __("public.employee")}}</label>
                        <input wire:model.defer="holiday.employee" type="text" class="form-control text-center"
                               id="employee" required>
                        @error('holiday.employee') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="holiday.notes" type="text" class="form-control text-center"
                                  id="notes" required></textarea>
                        @error('holiday.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    @can(\App\Enums\AppPermissions::CAN_CREATE_HOLIDAYS)
                        <button class="btn btn-success" wire:click="save">
                            {{ __('public.save') }}
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
