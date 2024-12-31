<?php

namespace App\Http\Livewire\JopCards;

use App\Models\JopStatus;
use Livewire\Component;
use Livewire\WithPagination;

class JopCardsStatus extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $color = '#2ecc71';

    public $search;

    public $JopStatusId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
        'color' => 'required',
    ];

    public function render()
    {
        return view('livewire.jop-cards.jop-cards-status', [
            'statues' => JopStatus::query()->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->JopStatusId = $id;
        $item = JopStatus::query()->findOrFail($this->JopStatusId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->color = $item->color;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->JopStatusId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new JopStatus();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->color = $this->color;
            $item->save();
        } else {
            $item = JopStatus::query()->findOrFail($id);
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->color = $this->color;
            $item->save();
        }
    }

    public function save()
    {
        $this->validate();
        $this->item(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->JopStatusId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        JopStatus::query()->findOrFail($this->JopStatusId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->JopStatusId = null;
        $this->reset();
    }
}
