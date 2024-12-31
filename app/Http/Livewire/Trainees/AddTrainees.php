<?php

namespace App\Http\Livewire\Trainees;

use App\Models\Trainee;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddTrainees extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public Trainee $trainee;
    public $image;

    protected $rules = [
        'trainee.traineeAr' => 'required|max:200',
        'trainee.traineeEn' => 'required|max:200',
        'trainee.email' => 'required|max:200',
        'trainee.phone' => 'required|max:200',
        'trainee.idNumber' => 'max:200',
        'trainee.jobName' => 'max:200',
        'trainee.gender' => 'max:200',
        'trainee.nationality' => 'max:200',
        'trainee.religion' => 'max:200',
        'trainee.status' => 'max:200',
        'trainee.address' => 'max:200',
        'trainee.academicQualification' => 'max:200',
        'trainee.typeAcademic' => 'max:200',
        'trainee.dateAcademic' => 'max:200',
        'trainee.placeAcademic' => 'max:200',
        'trainee.trainingDepartment' => 'max:200',
        'trainee.trainingDuration' => 'max:200',
        'trainee.trainingSalary' => 'max:200',
        'trainee.startTrainingDate' => 'max:200',
        'trainee.endTrainingDate' => 'max:200',
        'trainee.trainingPlace' => 'max:200',
        'trainee.attendTraining' => 'max:200',
        'trainee.managementSkills' => 'max:200',
        'trainee.technicalSkills' => 'max:200',
        'trainee.evaluationTrainee' => 'max:200',
        'trainee.image' => 'max:200',
        'trainee.notes' => 'max:200',
    ];

    public function mount()
    {
        $this->trainee = new Trainee();
    }

    public function render()
    {
        return view('livewire.trainees.add-trainees');
    }

    public function save()
    {
        $this->validate();
        if ($this->image) {
            if ($this->trainee->image) {
                unlink($this->trainee->image);
            }
            $path = $this->image->store('photo', 'public');
            $this->trainee->image = 'storage/' . $path;
        }
        $this->trainee->save();
        $this->notify('success', trans('public.success'));
        to_route('trianees');
    }
}
