<?php

namespace App\Http\Livewire\Holiday;

use App\Models\Holiday;
use App\Models\Employee;
use App\Models\HolidayCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddHoliday extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public Holiday $holiday;
    public $category, $employee;
    protected $items, $options;

    protected $rules = [
        'category' => 'required',
        'employee' => 'required',
        'holiday.name' => 'required|max:200',
        'holiday.amount' => 'numeric|min:0',
        'holiday.fromDate' => 'required|date',
        'holiday.toDate' => 'required|date',
        'holiday.date' => 'required|date',
        'holiday.startDate' => 'required|date',
        'holiday.employee' => 'required|max:200',
        'holiday.notes' => 'max:200',
    ];

    public function mount()
    {
        $this->holiday = new Holiday();
    }

    public function render()
    {
        return view('livewire.holiday.add-holiday');
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
            $this->options = HolidayCategory::orderBy(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'asc')->pluck(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'id');
        }
        return $this->options;
    }

    public function save()
    {
        $this->validate();
        $this->holiday->employee_id = $this->employee;
        $this->holiday->holiday_category_id = $this->category;
        $this->holiday->save();
        $this->notify('success', trans('public.success'));
        to_route('holidays');
    }
}
