<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.employees") }}</h4>
            </div>
            <div class="card-body">
                <div class="row  border-bottom p-3">
                    <div class="col-md-12 text-center">
                        <img src="{{asset($employee->image ?? 'images/no_image.png')}}" class="rounded img-fuild img-thumbnail" alt="image" height="120" width="120">
                    </div>
                    <div class="col-md-3">
                        <label for="category" class="form-label mt-2">{{ __("public.categoriesEmployees")}}*</label>
                        <input value="{{app()->getLocale()=='ar' ? $employee->category->arName : $employee->category->enName}}" type="text" class="form-control text-center" id="employeeNumber" disabled>
                        @error('category') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label mt-2">{{ __("public.state")}}</label>
                        <select wire:model.defer="employee.status" class="form-select" id="status" disabled>
                            <option value="1">{{__('public.active')}}</option>
                            <option value="0">{{__('public.notActive')}}</option>
                        </select>
                        @error('employee.status') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="employeeNumber" class="form-label mt-2">{{ __("public.employeeNumber")}}</label>
                        <input wire:model.defer="employee.employeeNumber" type="text" class="form-control text-center" id="employeeNumber" disabled>
                        @error('employee.employeeNumber') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="joinDate" class="form-label mt-2">{{ __("public.joinDate")}}</label>
                        <input wire:model.defer="employee.joinDate" type="date" class="form-control text-center" id="joinDate" disabled>
                        @error('employee.joinDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="employeeNameAr" class="form-label mt-2">{{ __("public.employeeNameAr")}}</label>
                        <input wire:model.defer="employee.employeeNameAr" type="text" class="form-control text-center" id="employeeNameAr" disabled>
                        @error('employee.employeeNameAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="employeeNameEn" class="form-label mt-2">{{ __("public.employeeNameEn")}}</label>
                        <input wire:model.defer="employee.employeeNameEn" type="text" class="form-control text-center" id="employeeNameEn" disabled>
                        @error('employee.employeeNameEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label mt-2">{{ __("public.email")}}</label>
                        <input wire:model.defer="employee.email" type="text" class="form-control text-center" id="email" disabled>
                        @error('employee.email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label mt-2">{{ __("public.phone")}}</label>
                        <input wire:model.defer="employee.phone" type="text" class="form-control text-center" id="phone" disabled>
                        @error('employee.phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="password" class="form-label mt-2">{{ __("public.password")}}</label>
                        <input wire:model.defer="employee.password" type="password" class="form-control text-center" id="password" disabled>
                        @error('employee.password') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="jopNameAr" class="form-label mt-2">{{ __("public.jopNameAr")}}</label>
                        <input wire:model.defer="employee.jopNameAr" type="text" class="form-control text-center" id="jopNameAr" disabled>
                        @error('employee.jopNameAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jopNameEn" class="form-label mt-2">{{ __("public.jopNameEn")}}</label>
                        <input wire:model.defer="employee.jopNameEn" type="text" class="form-control text-center" id="jopNameEn" disabled>
                        @error('employee.jopNameEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="birthDate" class="form-label mt-2">{{ __("public.birthDate")}}</label>
                        <input wire:model.defer="employee.birthDate" type="date" class="form-control text-center" id="birthDate" disabled>
                        @error('employee.birthDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="gender" class="form-label mt-2">{{ __("public.gender")}}</label>
                        <select wire:model.defer="employee.gender" class="form-select" id="gender" disabled>
                            <option selected value="{{app()->getLocale()=='ar' ? 'ذكر': 'male'}}">{{__('public.male')}}</option>
                            <option value="{{app()->getLocale()=='ar' ? 'أنثى': 'female'}}">{{__('public.female')}}</option>
                        </select>
                        @error('employee.gender') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="nationality" class="form-label mt-2">{{ __("public.nationality")}}</label>
                        <input wire:model.defer="employee.nationality" type="text" class="form-control text-center" id="nationality" disabled>
                        @error('employee.nationality') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="religion" class="form-label mt-2">{{ __("public.religion")}}</label>
                        <input wire:model.defer="employee.religion" type="text" class="form-control text-center" id="religion" disabled>
                        @error('employee.religion') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="socialStatus" class="form-label mt-2">{{ __("public.socialStatus")}}</label>
                        <input wire:model.defer="employee.socialStatus" type="text" class="form-control text-center" id="socialStatus" disabled>
                        @error('employee.socialStatus') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="idNumber" class="form-label mt-2">{{ __("public.idNumber")}}</label>
                        <input wire:model.defer="employee.idNumber" type="text" class="form-control text-center" id="idNumber" disabled>
                        @error('employee.idNumber') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="dateOfIssue" class="form-label mt-2">{{ __("public.dateOfIssue")}}</label>
                        <input wire:model.defer="employee.dateOfIssue" type="date" class="form-control text-center" id="dateOfIssue" disabled>
                        @error('employee.dateOfIssue') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="expiryDate" class="form-label mt-2">{{ __("public.expiryDate")}}</label>
                        <input wire:model.defer="employee.expiryDate" type="date" class="form-control text-center" id="expiryDate" disabled>
                        @error('employee.expiryDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="passportNumber" class="form-label mt-2">{{ __("public.passportNumber")}}</label>
                        <input wire:model.defer="employee.passportNumber" type="text" class="form-control text-center" id="passportNumber" disabled>
                        @error('employee.passportNumber') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="passportDateOfIssue" class="form-label mt-2">{{ __("public.passportDateOfIssue")}}</label>
                        <input wire:model.defer="employee.passportDateOfIssue" type="date" class="form-control text-center" id="passportDateOfIssue" disabled>
                        @error('employee.passportDateOfIssue') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="passportExpiryDate" class="form-label mt-2">{{ __("public.passportExpiryDate")}}</label>
                        <input wire:model.defer="employee.passportExpiryDate" type="date" class="form-control text-center" id="passportExpiryDate" disabled>
                        @error('employee.passportExpiryDate') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="placeOfIssue" class="form-label mt-2">{{ __("public.placeOfIssue")}}</label>
                        <input wire:model.defer="employee.placeOfIssue" type="text" class="form-control text-center" id="placeOfIssue" disabled>
                        @error('employee.placeOfIssue') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="academicQualification" class="form-label mt-2">{{ __("public.academicQualification")}}</label>
                        <input wire:model.defer="employee.academicQualification" type="text" class="form-control text-center" id="academicQualification" disabled>
                        @error('employee.academicQualification') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="typeAcademic" class="form-label mt-2">{{ __("public.typeAcademic")}}</label>
                        <input wire:model.defer="employee.typeAcademic" type="date" class="form-control text-center" id="typeAcademic" disabled>
                        @error('employee.typeAcademic') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="dateAcademic" class="form-label mt-2">{{ __("public.dateAcademic")}}</label>
                        <input wire:model.defer="employee.dateAcademic" type="date" class="form-control text-center" id="dateAcademic" disabled>
                        @error('employee.dateAcademic') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="placeAcademic" class="form-label mt-2">{{ __("public.placeAcademic")}}</label>
                        <input wire:model.defer="employee.placeAcademic" type="text" class="form-control text-center" id="placeAcademic" disabled>
                        @error('employee.placeAcademic') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row  border-bottom p-3">
                    <div class="col-md-3">
                        <label for="address" class="form-label mt-2">{{ __("public.address")}}</label>
                        <input wire:model.defer="employee.address" type="text" class="form-control text-center" id="address" disabled>
                        @error('employee.address') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="employee.notes" type="text" class="form-control text-center" id="notes" disabled></textarea>
                        @error('employee.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
