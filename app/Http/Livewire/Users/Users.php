<?php

namespace App\Http\Livewire\Users;

use App\Enums\AppPermissions;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $search;

    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $role;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    protected $items;

    public function getOptions()
    {
        if ($this->items == null) {
            $this->items = Role::where('name', '!=', 'super-admin')
                ->orderBy('name', 'asc')->pluck('name', 'id');
        }

        return $this->items;
    }

    public function render()
    {
        $admin = Auth::user()->email == 'super@super.com';
        if ($admin) {
            return view('livewire.users.users', [
                'users' => User::query()
                    ->with(['roles', 'permissions'])
                    ->mySearch($this->search)
                    ->latest()
                    ->paginate(10),
            ]);
        }

        return view('livewire.users.users', [
            'users' => User::query()
                ->where('email', '!=', 'super@super.com')
                ->with(['roles', 'permissions'])
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    private function user(bool $new, $id): void
    {
        $user = $new ? new User() : User::query()->findOrFail($id);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($new) {
            $user->password = Hash::make($this->password);
            $user->email_verified_at = now();
        } else {
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->removeRole($user->roles[0]->name);
        }
        $user->save();
        $user->assignRole($this->role);
    }

    public function save(): void
    {
        $this->validate();
        $this->user(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function add(): void
    {
        if (! Auth::user()->can(AppPermissions::CAN_CREATE_USERS)) {
            to_route('users');
        }
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id): void
    {
        $this->userId = $id;
        $user = User::query()->findOrFail($this->userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->id;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateUser(): void
    {
        $this->validate([
            'name' => 'required|max:50',
            'role' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'password' => 'required|max:50',
        ]);
        $this->user(false, $this->userId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset('name');
    }

    public function remove($id): void
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete(): void
    {
        User::query()->with('roles')->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'role' => 'required|max:50',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:50',
            'password_confirmation' => 'required|same:password|max:50',
        ];
    }
}
