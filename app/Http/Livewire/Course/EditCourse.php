<?php

namespace App\Http\Livewire\Course;

use App\Models\Employee;
use App\Models\Course;
use Livewire\Component;

class EditCourse extends Component
{
    protected $paginationTheme = 'bootstrap';
    public Course $course;
    public $category;
    protected $items;

    protected $rules = [
        'category' => 'required',
        'course.name' => 'required|max:200',
        'course.fromDate' => 'required|date',
        'course.toDate' => 'required|date',
        'course.notes' => 'max:200',
    ];

    public function mount($id)
    {
        $this->course = Course::query()->find($id);
        $this->category = $this->course->employee_id;
    }

    public function render()
    {
        return view('livewire.course.edit-course');
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
        $this->course->employee_id = $this->category;
        $this->course->save();
        $this->notify('success', trans('public.success'));
        to_route('courses');
    }
}
