<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\EmployeeCategory;
use App\Models\Trainee;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEmployee extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public Employee $employee;
    public $image;
    public $category;
    protected $items;

    protected $rules = [
        'category' => 'required',
        'employee.status' => 'required',
        'employee.employeeNumber' => 'required|max:200',
        'employee.joinDate' => 'required|max:200',
        'employee.employeeNameAr' => 'required|max:200',
        'employee.employeeNameEn' => 'required|max:200',
        'employee.email' => 'nullable|string|max:200',
        'employee.phone' => 'nullable|string|max:200',
        'employee.password' => 'nullable|string|max:200',
        'employee.jopNameAr' => 'required|max:200',
        'employee.jopNameEn' => 'required|max:200',
        'employee.birthDate' => 'max:200',
        'employee.gender' => 'max:200',
        'employee.nationality' => 'max:200',
        'employee.religion' => 'max:200',
        'employee.socialStatus' => 'max:200',
        'employee.idNumber' => 'max:200',
        'employee.dateOfIssue' => 'max:200',
        'employee.expiryDate' => 'max:200',
        'employee.passportNumber' => 'max:200',
        'employee.passportDateOfIssue' => 'max:200',
        'employee.passportExpiryDate' => 'max:200',
        'employee.placeOfIssue' => 'max:200',
        'employee.academicQualification' => 'max:200',
        'employee.typeAcademic' => 'max:200',
        'employee.dateAcademic' => 'max:200',
        'employee.placeAcademic' => 'max:200',
        'employee.address' => 'max:200',
        'employee.image' => 'max:200',
        'employee.notes' => 'max:200',
    ];

    public function mount($id)
    {
        $this->employee = Employee::query()->find($id);
        $this->category = $this->employee->employee_category_id;
    }

    public function render()
    {
        return view('livewire.employee.edit-employee');
    }

    public function getOptions()
    {
        if ($this->items == null) {
            if (app()->getLocale() == 'ar') {
                $this->items = EmployeeCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->items = EmployeeCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }
        return $this->items;
    }

    public function save()
    {
        $this->validate();
        if ($this->image) {
            if ($this->employee->image) {
                unlink($this->employee->image);
            }
            $path = $this->image->store('photo', 'public');
            $this->employee->image = 'storage/' . $path;
        }
        $this->employee->employee_category_id = $this->category;
        $this->employee->save();
        $this->notify('success', trans('public.success'));
        to_route('employees');
    }
}
