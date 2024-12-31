<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRole extends Component
{
    public $name, $role;
    public $selectedPermissions = [];
    public $selectAll = false;

    public function mount($id)
    {
        $this->role = Role::query()->findOrFail($id);
        $this->name = $this->role->name;
        foreach ($this->role->permissions as $permission) {
            $this->selectedPermissions[$permission->id] = $permission->id;
        }
    }

    public function render()
    {
        return view('livewire.role.update-role', [
            'all_permissions' => Permission::all(),
        ]);
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required',
        ]);
        $this->role->name = $this->name;
        $this->role->syncPermissions($this->selectedPermissions);
        $this->notify('success', trans('public.success'));
        to_route('roles');
    }
}
