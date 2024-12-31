<?php

namespace App\Http\Livewire\Suppliers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SuppliersPage extends Component
{
    use WithPagination;

    public $search;

    public $name;

    public $phone;

    public $email;

    public $address;

    public $notes;

    public $supplierId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.suppliers.suppliers-page', [
            'suppliers' => Supplier::query()
                ->with('user')
                ->withCount('purchases')
                ->withSum('purchases', 'total')
                ->withSum('payments', 'amount')
                ->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->supplierId = $id;
        $item = Supplier::query()->findOrFail($this->supplierId);
        $this->name = $item->name;
        $this->phone = $item->phone;
        $this->email = $item->email;
        $this->address = $item->address;
        $this->notes = $item->notes;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCustomer()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);
        $this->customer(false, $this->supplierId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset('name');
    }

    private function customer(bool $new, $id)
    {
        if ($new) {
            $item = new Supplier();
            $item->name = $this->name;
            $item->phone = $this->phone;
            $item->email = $this->email;
            $item->address = $this->address;
            $item->notes = $this->notes;
            $item->user_id = Auth::id();
            $item->save();
        } else {
            $item = Supplier::query()->findOrFail($id);
            $item->name = $this->name;
            $item->phone = $this->phone;
            $item->email = $this->email;
            $item->address = $this->address;
            $item->notes = $this->notes;
            $item->user_id = Auth::id();
            $item->save();
        }
    }

    public function save()
    {
        $this->validate();
        $this->customer(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->supplierId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Supplier::query()->findOrFail($this->supplierId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->supplierId = null;
        $this->reset();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:250',
            'phone' => 'required|unique:suppliers',
        ];
    }
}
