<?php

namespace App\Http\Livewire\Allowance;

use App\Models\Employee;
use App\Models\Allowance;
use App\Models\AllowanceCategory;
use Livewire\Component;

class EditAllowance extends Component
{
    protected $paginationTheme = 'bootstrap';
    public Allowance $allowance;
    public $category, $employee;
    protected $items, $options;

    protected $rules = [
        'category' => 'required',
        'employee' => 'required',
        'allowance.name' => 'required|max:200',
        'allowance.amount' => 'numeric|min:0',
        'allowance.date' => 'required|date',
        'allowance.notes' => 'max:200',
    ];

    public function mount($id)
    {
        $this->allowance = Allowance::query()->find($id);
        $this->category = $this->allowance->allowance_category_id;
    }

    public function render()
    {
        return view('livewire.allowance.edit-allowance');
    }

    public function getEmployees()
    {
        if ($this->items == null) {
            $this->items = Employee::orderBy(app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'asc')->select('id', app()->getLocale() == 'ar' ? 'employeeNameAr' : 'employeeNameAr', 'phone')->get();
        }
        return $this->items;
    }

    public function getCategories()
    {
        if ($this->options == null) {
            $this->options = AllowanceCategory::orderBy(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'asc')->pluck(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'id');
        }
        return $this->options;
    }

    public function save()
    {
        $this->validate();
        $this->allowance->employee_id = $this->employee;
        $this->allowance->allowance_category_id = $this->category;
        $this->allowance->save();
        $this->notify('success', trans('public.success'));
        to_route('allowances');
    }
}
