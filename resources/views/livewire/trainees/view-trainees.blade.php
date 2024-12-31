<div>
    <div class="container-fluid px-5">
        <div class="card">
            <div class="card-header">
                <h4>{{ __("public.trainees") }}</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-md-12 text-center">
                        <img src="{{asset($trainee->image ?? 'images/no_image.png')}}" class="rounded img-fuild img-thumbnail" alt="image" height="120" width="120">
                    </div>
                    <div class="col-md-3">
                        <label for="traineeAr" class="form-label mt-2">{{ __("public.traineeAr")}}</label>
                        <input disabled wire:model.defer="trainee.traineeAr" type="text" class="form-control text-center" id="traineeAr" required>
                    </div>
                    <div class="col-md-3">
                        <label for="traineeEn" class="form-label mt-2">{{ __("public.traineeEn")}}</label>
                        <input disabled wire:model.defer="trainee.traineeEn" type="text" class="form-control text-center" id="traineeEn" required>
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label mt-2">{{ __("public.email")}}</label>
                        <input disabled wire:model.defer="trainee.email" type="text" class="form-control text-center" id="email" required>
                    </div>
                    <div class="col-md-3">
                        <label for="phone" class="form-label mt-2">{{ __("public.phone")}}</label>
                        <input disabled wire:model.defer="trainee.phone" type="text" class="form-control text-center" id="phone" required>
                    </div>
                    <div class="col-md-3">
                        <label for="idNumber" class="form-label mt-2">{{ __("public.idNumber")}}</label>
                        <input disabled wire:model.defer="trainee.idNumber" type="text" class="form-control text-center" id="idNumber" required>
                    </div>
                    <div class="col-md-3">
                        <label for="jobName" class="form-label mt-2">{{ __("public.jobName")}}</label>
                        <input disabled wire:model.defer="trainee.jobName" type="text" class="form-control text-center" id="jobName" required>
                    </div>
                    <div class="col-md-3">
                        <label for="gender" class="form-label mt-2">{{ __("public.gender")}}</label>
                        <input disabled wire:model.defer="trainee.gender" type="text" class="form-control text-center" id="gender" required>
                    </div>
                    <div class="col-md-3">
                        <label for="nationality" class="form-label mt-2">{{ __("public.nationality")}}</label>
                        <input disabled wire:model.defer="trainee.nationality" type="text" class="form-control text-center" id="nationality" required>
                    </div>
                    <div class="col-md-3">
                        <label for="religion" class="form-label mt-2">{{ __("public.religion")}}</label>
                        <input disabled wire:model.defer="trainee.religion" type="text" class="form-control text-center" id="religion" required>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label mt-2">{{ __("public.status")}}</label>
                        <input disabled wire:model.defer="trainee.status" type="text" class="form-control text-center" id="status" required>
                    </div>
                    <div class="col-md-3">
                        <label for="address" class="form-label mt-2">{{ __("public.address")}}</label>
                        <input disabled wire:model.defer="trainee.address" type="text" class="form-control text-center" id="address" required>
                    </div>
                    <div class="col-md-3">
                        <label for="academicQualification" class="form-label mt-2">{{ __("public.academicQualification")}}</label>
                        <input disabled wire:model.defer="trainee.academicQualification" type="text" class="form-control text-center" id="academicQualification" required>
                    </div>
                    <div class="col-md-3">
                        <label for="typeAcademic" class="form-label mt-2">{{ __("public.typeAcademic")}}</label>
                        <input disabled wire:model.defer="trainee.typeAcademic" type="text" class="form-control text-center" id="typeAcademic" required>
                    </div>
                    <div class="col-md-3">
                        <label for="dateAcademic" class="form-label mt-2">{{ __("public.dateAcademic")}}</label>
                        <input disabled wire:model.defer="trainee.dateAcademic" type="date" class="form-control text-center" id="dateAcademic" required>
                    </div>
                    <div class="col-md-3">
                        <label for="placeAcademic" class="form-label mt-2">{{ __("public.placeAcademic")}}</label>
                        <input disabled wire:model.defer="trainee.placeAcademic" type="text" class="form-control text-center" id="placeAcademic" required>
                    </div>
                    <div class="col-md-3">
                        <label for="trainingDepartment" class="form-label mt-2">{{ __("public.trainingDepartment")}}</label>
                        <input disabled wire:model.defer="trainee.trainingDepartment" type="text" class="form-control text-center" id="trainingDepartment" required>
                    </div>
                    <div class="col-md-3">
                        <label for="trainingDuration" class="form-label mt-2">{{ __("public.trainingDuration")}}</label>
                        <input disabled wire:model.defer="trainee.trainingDuration" type="text" class="form-control text-center" id="trainingDuration" required>
                    </div>
                    <div class="col-md-3">
                        <label for="trainingSalary" class="form-label mt-2">{{ __("public.trainingSalary")}}</label>
                        <input disabled wire:model.defer="trainee.trainingSalary" type="text" class="form-control text-center" id="trainingSalary" required>
                    </div>
                    <div class="col-md-3">
                        <label for="startTrainingDate" class="form-label mt-2">{{ __("public.startTrainingDate")}}</label>
                        <input disabled wire:model.defer="trainee.startTrainingDate" type="date" class="form-control text-center" id="startTrainingDate" required>
                    </div>
                    <div class="col-md-3">
                        <label for="endTrainingDate" class="form-label mt-2">{{ __("public.endTrainingDate")}}</label>
                        <input disabled wire:model.defer="trainee.endTrainingDate" type="date" class="form-control text-center" id="endTrainingDate" required>
                    </div>
                    <div class="col-md-3">
                        <label for="trainingPlace" class="form-label mt-2">{{ __("public.trainingPlace")}}</label>
                        <input disabled wire:model.defer="trainee.trainingPlace" type="text" class="form-control text-center" id="trainingPlace" required>
                    </div>
                    <div class="col-md-3">
                        <label for="attendTraining" class="form-label mt-2">{{ __("public.attendTraining")}}</label>
                        <input disabled wire:model.defer="trainee.attendTraining" type="text" class="form-control text-center" id="attendTraining" required>
                    </div>
                    <div class="col-md-3">
                        <label for="managementSkills" class="form-label mt-2">{{ __("public.managementSkills")}}</label>
                        <input disabled wire:model.defer="trainee.managementSkills" type="text" class="form-control text-center" id="managementSkills" required>
                    </div>
                    <div class="col-md-3">
                        <label for="technicalSkills" class="form-label mt-2">{{ __("public.technicalSkills")}}</label>
                        <input disabled wire:model.defer="trainee.technicalSkills" type="text" class="form-control text-center" id="technicalSkills" required>
                    </div>
                    <div class="col-md-3">
                        <label for="evaluationTrainee" class="form-label mt-2">{{ __("public.evaluationTrainee")}}</label>
                        <input disabled wire:model.defer="trainee.evaluationTrainee" type="text" class="form-control text-center" id="evaluationTrainee" required>
                    </div>
                    <div class="col-md-12">
                        <label for="notes" class="form-label mt-2">{{ __("public.notes")}}</label>
                        <textarea disabled wire:model.defer="trainee.notes" type="text" class="form-control text-center" id="notes" required></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
