<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.employees") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="category" class="form-label mt-2">{{ __("public.employees")}}*</label>
                        <select name="category" wire:model.defer="category" class="form-select">
                            <option value="">{{__('public.choose')}}</option>
                            @foreach($this->getEmployees() as $item)
                            <option value="{{ $item->id }}" >{{ app()->getLocale() == 'ar' ? $item->employeeNameAr : $item->employeeNameAr }} / {{$item->phone}}</option>
                            @endforeach
                        </select>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="contractName" class="form-label mt-2">{{ __("public.contractName")}}</label>
                        <input wire:model.defer="contract.contractName" type="text" class="form-control text-center" id="contractName" required>
                        @error('contract.contractName') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jobNameAr" class="form-label mt-2">{{ __("public.jobNameAr")}}</label>
                        <input wire:model.defer="contract.jobNameAr" type="text" class="form-control text-center" id="jobNameAr" required>
                        @error('contract.jobNameAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jobNameEn" class="form-label mt-2">{{ __("public.jobNameEn")}}</label>
                        <input wire:model.defer="contract.jobNameEn" type="text" class="form-control text-center" id="jobNameEn" required>
                        @error('contract.jobNameEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="contractDuration" class="form-label mt-2">{{ __("public.contractDuration")}}</label>
                        <input wire:model.defer="contract.contractDuration" type="text" class="form-control text-center" id="contractDuration" required>
                        @error('contract.contractDuration') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="startDateContract" class="form-label mt-2">{{ __("public.startDateContract")}}</label>
                        <input wire:model.defer="contract.startDateContract" type="date" class="form-control text-center" id="startDateContract" required>
                        @error('contract.startDateContract') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="endDateContract" class="form-label mt-2">{{ __("public.endDateContract")}}</label>
                        <input wire:model.defer="contract.endDateContract" type="date" class="form-control text-center" id="endDateContract" required>
                        @error('contract.endDateContract') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="dateContract" class="form-label mt-2">{{ __("public.dateContract")}}</label>
                        <input wire:model.defer="contract.dateContract" type="date" class="form-control text-center" id="dateContract" required>
                        @error('contract.dateContract') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="basicSalary" class="form-label mt-2">{{ __("public.basicSalary")}}</label>
                        <input wire:model.defer="contract.basicSalary" type="number" class="form-control text-center" id="basicSalary" required>
                        @error('contract.basicSalary') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="costOfLivingAllowance" class="form-label mt-2">{{ __("public.costOfLivingAllowance")}}</label>
                        <input wire:model.defer="contract.costOfLivingAllowance" type="number" class="form-control text-center" id="costOfLivingAllowance" required>
                        @error('contract.costOfLivingAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="foodAllowance" class="form-label mt-2">{{ __("public.foodAllowance")}}</label>
                        <input wire:model.defer="contract.foodAllowance" type="number" class="form-control text-center" id="foodAllowance" required>
                        @error('contract.foodAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="transferAllowance" class="form-label mt-2">{{ __("public.transferAllowance")}}</label>
                        <input wire:model.defer="contract.transferAllowance" type="number" class="form-control text-center" id="transferAllowance" required>
                        @error('contract.transferAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="overtime" class="form-label mt-2">{{ __("public.overtime")}}</label>
                        <input wire:model.defer="contract.overtime" type="number" class="form-control text-center" id="overtime" required>
                        @error('contract.overtime') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="housingAllowance" class="form-label mt-2">{{ __("public.housingAllowance")}}</label>
                        <input wire:model.defer="contract.housingAllowance" type="number" class="form-control text-center" id="housingAllowance" required>
                        @error('contract.housingAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="phoneAllowance" class="form-label mt-2">{{ __("public.phoneAllowance")}}</label>
                        <input wire:model.defer="contract.phoneAllowance" type="number" class="form-control text-center" id="phoneAllowance" required>
                        @error('contract.phoneAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="otherAllowance" class="form-label mt-2">{{ __("public.otherAllowance")}}</label>
                        <input wire:model.defer="contract.otherAllowance" type="number" class="form-control text-center" id="otherAllowance" required>
                        @error('contract.otherAllowance') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="medical" class="form-label mt-2">{{ __("public.medical")}}</label>
                        <input wire:model.defer="contract.medical" type="number" class="form-control text-center" id="medical" required>
                        @error('contract.medical') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="socialInsuranceDiscount" class="form-label mt-2">{{ __("public.socialInsuranceDiscount")}}</label>
                        <input wire:model.defer="contract.socialInsuranceDiscount" type="number" class="form-control text-center" id="socialInsuranceDiscount" required>
                        @error('contract.socialInsuranceDiscount') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="totalSalary" class="form-label mt-2">{{ __("public.totalSalary")}}</label>
                        <input wire:model.defer="contract.totalSalary" type="number" class="form-control text-center" id="totalSalary" required>
                        @error('contract.totalSalary') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-12">
                        <label for="contractTermsAr" class="form-label mt-2">{{ __("public.contractTermsAr")}}</label>
                        <textarea wire:model.defer="contract.contractTermsAr" type="text" class="form-control text-center" id="contractTermsAr" required></textarea>
                        @error('contract.contractTermsAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="contractTermsEn" class="form-label mt-2">{{ __("public.contractTermsEn")}}</label>
                        <textarea wire:model.defer="contract.contractTermsEn" type="text" class="form-control text-center" id="contractTermsEn" required></textarea>
                        @error('contract.contractTermsEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="contract.notes" type="text" class="form-control text-center" id="notes" required></textarea>
                        @error('contract.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                @can(\App\Enums\AppPermissions::CAN_CREATE_CONTRACTS)
                <button class="btn btn-success" wire:click="save">
                    {{ __('public.save') }}
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
