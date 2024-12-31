<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.courses") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="category" class="form-label mt-2">{{ __("public.employees")}}*</label>
                        <select name="category" wire:model.defer="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
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
                        <input wire:model.defer="course.name" type="text" class="form-control text-center" id="name"
                               required>
                        @error('course.name') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="fromDate" class="form-label mt-2">{{ __("public.fromDate")}}</label>
                        <input wire:model.defer="course.fromDate" type="date" class="form-control text-center"
                               id="fromDate" required>
                        @error('course.fromDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="toDate" class="form-label mt-2">{{ __("public.toDate")}}</label>
                        <input wire:model.defer="course.toDate" type="date" class="form-control text-center" id="toDate"
                               required>
                        @error('course.toDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="course.notes" type="text" class="form-control text-center"
                                  id="notes" required></textarea>
                        @error('course.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                @can(\App\Enums\AppPermissions::CAN_CREATE_COURSES)
                    <button class="btn btn-success" wire:click="save">
                        {{ __('public.save') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
