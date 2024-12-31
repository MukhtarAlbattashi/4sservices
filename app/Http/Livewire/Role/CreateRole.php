<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Component
{
    public $name;
    public $permissions = [];
    public $selectAll = false;

    public function render()
    {
        return view('livewire.role.create-role', [
            'all_permissions' => Permission::all(),
        ]);
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->permissions);
        $this->notify('success', trans('public.success'));
        to_route('roles');
    }

    public function updatedSelectAll($value)
    {
        $this->permissions = $value ? Permission::pluck('name')->toArray() : [];
    }
}
