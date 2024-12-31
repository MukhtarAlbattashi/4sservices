<?php

namespace App\Http\Livewire\Contract;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\Setting;
use App\Traits\HasSettings;
use Livewire\Component;

class ViewContract extends Component
{
    use HasSettings;
    protected $paginationTheme = 'bootstrap';
    public Contract $contract;
    public Setting $setting;
    public Employee $employee;

    public function mount($id)
    {
        $this->contract = Contract::query()->with('employee')->findOrFail($id);
        $this->setting = $this->getSettings();
        $this->employee = $this->contract->employee;
    }

    public function render()
    {
        return view('livewire.contract.view-contract')->extends('layouts.app')
            ->section('content');
    }
}
