<?php

namespace App\Http\Livewire\Discounts;

use App\Models\Discount;
use App\Models\DiscountCategory;
use App\Models\Employee;
use Livewire\Component;

class AddDiscount extends Component
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

    public function mount()
    {
        $this->discount = new Discount();
    }

    public function render()
    {
        return view('livewire.discounts.add-discount');
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
            $this->options = DiscountCategory::orderBy(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'asc')->pluck(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'id');
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
