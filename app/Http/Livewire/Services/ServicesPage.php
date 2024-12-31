<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ServicesPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $arName;

    public $enName;

    public $image;

    public $amount;

    public $notes;

    public $servicesId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
        'amount' => 'required',
    ];

    public function render()
    {
        return view('livewire.services.services-page', [
            'services' => Service::query()->with('user')->mySearch($this->search)->latest()->paginate(200),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->servicesId = $id;
        $item = Service::query()->findOrFail($this->servicesId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->image = $item->image;
        $this->amount = $item->amount;
        $this->notes = $item->notes;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateService()
    {
        $this->validate();
        $this->service(false, $this->servicesId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function service(bool $new, $id)
    {
        if ($new) {
            $item = new Service();
            $item->user_id = Auth::id();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->amount = $this->amount;
            $item->notes = $this->notes;
            if ($this->image) {
                $path = $this->image->store('photo', 'public');
                $item->image = 'storage/'.$path;
            }
            $item->save();
        } else {
            $item = Service::query()->findOrFail($id);
            $item->user_id = Auth::id();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->amount = $this->amount;
            $item->notes = $this->notes;
            $current = $item->image;
            if ($current != $this->image) {
                if ($item->image) {
                    unlink($item->image);
                }
                $path = $this->image->store('photo', 'public');
                $item->image = 'storage/'.$path;
            }
            $item->save();
        }
    }

    public function save()
    {
        $this->validate();
        $this->service(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->servicesId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        $item = Service::query()->findOrFail($this->servicesId);
        if ($item->image) {
            unlink($item->image);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->servicesId = null;
        $this->reset();
    }
}
