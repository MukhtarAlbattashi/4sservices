<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolePage extends Component
{
    use WithPagination;

    public $roleId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.role.role-page', [
            'roles' => Role::query()->where('name', '!=', 'super-admin')->paginate(10),
        ]);
    }

    public function remove($id): void
    {
        $this->roleId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete(): void
    {
        Role::query()->findOrFail($this->roleId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->reset();
    }
}
