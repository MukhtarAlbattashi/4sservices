<?php

namespace App\Http\Livewire\Contract;

use App\Models\Contract;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddContract extends Component
{
    use WithFileUploads;

    public Contract $contract;

    public $category;

    protected $paginationTheme = 'bootstrap';

    protected $items;

    protected $rules = [
        'category' => 'required',
        'contract.contractName' => 'max:200',
        'contract.jobNameAr' => 'max:200',
        'contract.jobNameEn' => 'max:200',
        'contract.contractDuration' => 'max:200',
        'contract.startDateContract' => 'max:200',
        'contract.endDateContract' => 'max:200',
        'contract.dateContract' => 'max:200',
        'contract.basicSalary' => 'max:200',
        'contract.costOfLivingAllowance' => 'max:200',
        'contract.foodAllowance' => 'max:200',
        'contract.transferAllowance' => 'max:200',
        'contract.overtime' => 'max:200',
        'contract.housingAllowance' => 'max:200',
        'contract.phoneAllowance' => 'max:200',
        'contract.otherAllowance' => 'max:200',
        'contract.medical' => 'max:200',
        'contract.socialInsuranceDiscount' => 'max:200',
        'contract.totalSalary' => 'max:200',
        'contract.contractTermsAr' => 'max:200',
        'contract.contractTermsEn' => 'max:200',
        'contract.notes' => 'max:200',
    ];

    public function mount()
    {
        $this->contract = new Contract();
    }

    public function render()
    {
        return view('livewire.contract.add-contract');
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
        $this->contract->employee_id = $this->category;
        $this->contract->save();
        $this->notify('success', trans('public.success'));
        to_route('contracts');
    }
}
