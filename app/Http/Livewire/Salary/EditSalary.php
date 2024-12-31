<?php

namespace App\Http\Livewire\Salary;

use App\Models\Employee;
use App\Models\Salary;
use Livewire\Component;

class EditSalary extends Component
{
    protected $paginationTheme = 'bootstrap';
    public Salary $salary;
    public $category;
    protected $items;

    protected $rules = [
        'category' => 'required',
        'salary.name' => 'required|max:200',
        'salary.amount' => 'required|numeric|min:0',
        'salary.date' => 'required|date',
        'salary.notes' => 'max:200',
    ];

    public function mount($id)
    {
        $this->salary = Salary::query()->find($id);
        $this->category = $this->salary->employee_id;
    }

    public function render()
    {
        return view('livewire.salary.edit-salary');
    }

    public function getEmployees()
    {
        if ($this->items == null) {
            $this->items = Employee::orderBy(app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'asc')->select('id', app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'phone')->get();
        }
        return $this->items;
    }

    public function save()
    {
        $this->validate();
        $this->salary->employee_id = $this->category;
        $this->salary->save();
        $this->notify('success', trans('public.success'));
        to_route('salaries');
    }
}
