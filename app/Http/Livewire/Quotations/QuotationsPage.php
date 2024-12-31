<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Quotation;
use Livewire\Component;
use Livewire\WithPagination;

class QuotationsPage extends Component
{
    use WithPagination;

    public $search;

    public $quotationId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.quotations.quotations-page', [
            'quotations' => Quotation::query()
                ->with(['user', 'car.customer', 'car', 'car.model', 'car.type', 'car.brand'])
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->quotationId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Quotation::query()->findOrFail($this->quotationId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->quotationId = null;
        $this->reset();
    }
}
