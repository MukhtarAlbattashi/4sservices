<?php

namespace App\Http\Livewire\Salary;

use App\Models\Employee;
use App\Models\Salary;
use Livewire\Component;

class AddSalary extends Component
{
    protected $paginationTheme = 'bootstrap';
    public Salary $salary;
    public $employee;
    protected $items;

    protected $rules = [
        'salary.name' => 'required|max:200',
        'employee' => 'required',
        'salary.amount' => 'required|numeric|min:0',
        'salary.date' => 'required|date',
        'salary.notes' => 'max:200',
    ];

    public function mount()
    {
        $this->salary = new Salary();
    }

    public function render()
    {
        return view('livewire.salary.add-salary');
    }

    public function getEmployees()
    {
        if ($this->items == null) {
            $this->items = Employee::orderBy(app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'asc')->select('id', app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'phone')->get();
        }
        $this->employee = $this->items[0]->id;
        return $this->items;
    }

    public function save()
    {
        $this->validate();
        $this->salary->employee_id = $this->employee;
        $this->salary->save();
        $this->notify('success', trans('public.success'));
        to_route('salaries');
    }
}
