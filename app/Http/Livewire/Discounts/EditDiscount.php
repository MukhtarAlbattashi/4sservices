<?php

namespace App\Http\Livewire\Discounts;

use App\Models\Employee;
use App\Models\Discount;
use App\Models\AllowanceCategory;
use Livewire\Component;

class EditDiscount extends Component
{
    protected $paginationTheme = 'bootstrap';
    public Discount $discount;
    public $category, $employee;
    protected $items, $options;

    protected $rules = [
        'category' => 'required',
        'employee' => 'required',
        'discount.name' => 'required|max:200',
        'discount.amount' => 'numeric|min:0',
        'discount.date' => 'required|date',
        'discount.notes' => 'max:200',
    ];

    public function mount($id)
    {
        $this->discount = Discount::query()->find($id);
        $this->category = $this->discount->discount_category_id;
    }

    public function render()
    {
        return view('livewire.discounts.edit-discount');
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
        $this->discount->employee_id = $this->employee;
        $this->discount->discount_category_id = $this->category;
        $this->discount->save();
        $this->notify('success', trans('public.success'));
        to_route('discounts');
    }
}
