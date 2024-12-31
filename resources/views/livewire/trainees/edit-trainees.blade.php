<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.trainees") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <label for="traineeAr" class="form-label mt-2">{{ __("public.traineeAr")}}</label>
                        <input wire:model.defer="trainee.traineeAr" type="text" class="form-control text-center"
                               id="traineeAr" required>
                        @error('trainee.traineeAr') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="traineeEn" class="form-label mt-2">{{ __("public.traineeEn")}}</label>
                        <input wire:model.defer="trainee.traineeEn" type="text" class="form-control text-center"
                               id="traineeEn" required>
                        @error('trainee.traineeEn') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label mt-2">{{ __("public.email")}}</label>
                        <input wire:model.defer="trainee.email" type="text" class="form-control text-center" id="email"
                               required>
                        @error('trainee.email') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label mt-2">{{ __("public.phone")}}</label>
                        <input wire:model.defer="trainee.phone" type="text" class="form-control text-center" id="phone"
                               required>
                        @error('trainee.phone') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="idNumber" class="form-label mt-2">{{ __("public.idNumber")}}</label>
                        <input wire:model.defer="trainee.idNumber" type="text" class="form-control text-center"
                               id="idNumber" required>
                        @error('trainee.idNumber') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="jobName" class="form-label mt-2">{{ __("public.jobName")}}</label>
                        <input wire:model.defer="trainee.jobName" type="text" class="form-control text-center"
                               id="jobName" required>
                        @error('trainee.jobName') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="gender" class="form-label mt-2">{{ __("public.gender")}}</label>
                        <select wire:model.defer="trainee.gender" class="form-select" id="gender" required>
                            <option selected
                                    value="{{app()->getLocale()=='ar' ? 'ذكر': 'male'}}">{{__('public.male')}}</option>
                            <option
                                value="{{app()->getLocale()=='ar' ? 'أنثى': 'female'}}">{{__('public.female')}}</option>
                        </select>
                        @error('trainee.gender') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="nationality" class="form-label mt-2">{{ __("public.nationality")}}</label>
                        <input wire:model.defer="trainee.nationality" type="text" class="form-control text-center"
                               id="nationality" required>
                        @error('trainee.nationality') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="religion" class="form-label mt-2">{{ __("public.religion")}}</label>
                        <input wire:model.defer="trainee.religion" type="text" class="form-control text-center"
                               id="religion" required>
                        @error('trainee.religion') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label mt-2">{{ __("public.status")}}</label>
                        <input wire:model.defer="trainee.status" type="text" class="form-control text-center"
                               id="status" required>
                        @error('trainee.status') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="address" class="form-label mt-2">{{ __("public.address")}}</label>
                        <input wire:model.defer="trainee.address" type="text" class="form-control text-center"
                               id="address" required>
                        @error('trainee.address') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="academicQualification"
                               class="form-label mt-2">{{ __("public.academicQualification")}}</label>
                        <input wire:model.defer="trainee.academicQualification" type="text"
                               class="form-control text-center" id="academicQualification" required>
                        @error('trainee.academicQualification') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="typeAcademic" class="form-label mt-2">{{ __("public.typeAcademic")}}</label>
                        <input wire:model.defer="trainee.typeAcademic" type="text" class="form-control text-center"
                               id="typeAcademic" required>
                        @error('trainee.typeAcademic') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="dateAcademic" class="form-label mt-2">{{ __("public.dateAcademic")}}</label>
                        <input wire:model.defer="trainee.dateAcademic" type="date" class="form-control text-center"
                               id="dateAcademic" required>
                        @error('trainee.dateAcademic') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="placeAcademic" class="form-label mt-2">{{ __("public.placeAcademic")}}</label>
                        <input wire:model.defer="trainee.placeAcademic" type="text" class="form-control text-center"
                               id="placeAcademic" required>
                        @error('trainee.placeAcademic') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="trainingDepartment"
                               class="form-label mt-2">{{ __("public.trainingDepartment")}}</label>
                        <input wire:model.defer="trainee.trainingDepartment" type="text"
                               class="form-control text-center" id="trainingDepartment" required>
                        @error('trainee.trainingDepartment') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="trainingDuration" class="form-label mt-2">{{ __("public.trainingDuration")}}</label>
                        <input wire:model.defer="trainee.trainingDuration" type="text" class="form-control text-center"
                               id="trainingDuration" required>
                        @error('trainee.trainingDuration') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="trainingSalary" class="form-label mt-2">{{ __("public.trainingSalary")}}</label>
                        <input wire:model.defer="trainee.trainingSalary" type="text" class="form-control text-center"
                               id="trainingSalary" required>
                        @error('trainee.trainingSalary') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="startTrainingDate"
                               class="form-label mt-2">{{ __("public.startTrainingDate")}}</label>
                        <input wire:model.defer="trainee.startTrainingDate" type="date" class="form-control text-center"
                               id="startTrainingDate" required>
                        @error('trainee.startTrainingDate') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="endTrainingDate" class="form-label mt-2">{{ __("public.endTrainingDate")}}</label>
                        <input wire:model.defer="trainee.endTrainingDate" type="date" class="form-control text-center"
                               id="endTrainingDate" required>
                        @error('trainee.endTrainingDate') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="trainingPlace" class="form-label mt-2">{{ __("public.trainingPlace")}}</label>
                        <input wire:model.defer="trainee.trainingPlace" type="text" class="form-control text-center"
                               id="trainingPlace" required>
                        @error('trainee.trainingPlace') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="attendTraining" class="form-label mt-2">{{ __("public.attendTraining")}}</label>
                        <select wire:model.defer="trainee.attendTraining" class="form-select" id="attendTraining"
                                required>
                            <option selected
                                    value="{{app()->getLocale()=='ar' ? 'نعم': 'yes'}}">{{__('public.yes')}}</option>
                            <option value="{{app()->getLocale()=='ar' ? 'لا': 'no'}}">{{__('public.no')}}</option>
                        </select> @error('trainee.attendTraining') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="managementSkills" class="form-label mt-2">{{ __("public.managementSkills")}}</label>
                        <input wire:model.defer="trainee.managementSkills" type="text" class="form-control text-center"
                               id="managementSkills" required>
                        @error('trainee.managementSkills') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="technicalSkills" class="form-label mt-2">{{ __("public.technicalSkills")}}</label>
                        <input wire:model.defer="trainee.technicalSkills" type="text" class="form-control text-center"
                               id="technicalSkills" required>
                        @error('trainee.technicalSkills') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="evaluationTrainee"
                               class="form-label mt-2">{{ __("public.evaluationTrainee")}}</label>
                        <input wire:model.defer="trainee.evaluationTrainee" type="text" class="form-control text-center"
                               id="evaluationTrainee" required>
                        @error('trainee.evaluationTrainee') <span
                            class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <img src="{{asset($trainee->image ?? 'images/no_image.png')}}" alt="" height="80">
                        <br>
                        <label for="image" class="form-label mt-2">{{ __("public.image")}}</label>
                        <input wire:model.defer="image" type="file" class="form-control text-center" id="image"
                               accept=".jpg, .png">
                        @error('image') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                        <span wire:loading wire:target="image">{{__('public.upload')}}</span>
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea wire:model.defer="trainee.notes" type="text" class="form-control text-center"
                                  id="notes" required></textarea>
                        @error('trainee.notes') <span class="error text-danger fs-6">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                @can(\App\Enums\AppPermissions::CAN_EDIT_TRAINEES)
                    <button class="btn btn-success" wire:click="save">
                        {{ __('public.save') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>
