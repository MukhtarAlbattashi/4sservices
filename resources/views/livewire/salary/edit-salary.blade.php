<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.salaries") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="category" class="form-label mt-2">{{ __("public.employees")}}*</label>
                        <select name="category" wire:model.defer="category" class="form-select">
                            @foreach($this->getEmployees() as $item)
                                <option
                                    value="{{ $item->id }}" >{{ app()->getLocale() == 'ar' ? $item->employeeNameAr : $item->employeeNameAr }}
                                    / {{$item->phone}}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label mt-2">{{ __("public.name")}}</label>
                        <input wire:model.defer="salary.name" type="text" class="form-control text-center" id="name"
                               required>
                        @error('salary.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="amount" class="form-label mt-2">{{ __("public.amount")}}</label>
                        <input wire:model.defer="salary.amount" type="number" class="form-control text-center"
                               id="amount" required>
                        @error('salary.amount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label mt-2">{{ __("public.date")}}</label>
                        <input wire:model.defer="salary.date" type="date" class="form-control text-center" id="date"
                               required>
                        @error('salary.date') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="salary.notes" type="text" class="form-control text-center"
                                  id="notes" required></textarea>
                        @error('salary.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                @can(\App\Enums\AppPermissions::CAN_EDIT_SALARIES)
                    <button class="btn btn-success" wire:click="save">
                        {{ __('public.save') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
