<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\EmployeeCategory;
use App\Models\Trainee;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewEmployee extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public Employee $employee;
    public $image;
    public $category;
    protected $items;

    protected $rules = [
        'employee.status' => 'required|max:200',
        'employee.employeeNumber' => 'required|max:200',
        'employee.joinDate' => 'required|max:200',
        'employee.employeeNameAr' => 'required|max:200',
        'employee.employeeNameEn' => 'required|max:200',
        'employee.email' => 'max:200',
        'employee.phone' => 'required|max:200',
        'employee.password' => 'required|max:200',
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
        $this->employee = Employee::query()->with('category')->find($id);
        
    }

    public function render()
    {
        return view('livewire.employee.view-employee');
    }
}
