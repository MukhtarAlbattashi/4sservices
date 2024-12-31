<?php

namespace App\Http\Livewire\JopCards;

use App\Models\Invoice;
use App\Models\JobCard;
use App\Models\JopStatus;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class JopCradsPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $status = 'new';

    public $search;

    public $jobCardId;

    public $jop_status_id = null;

    public $total = 0;

    public $late = 0;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->total = JobCard::query()->count();
        $this->late = JobCard::with('status')->whereDate('dateEntry', '<=', now()->subDays(7))
            ->whereHas('status', function ($q) {
                $q->where('arName', '!=', 'تم الانتهاء')
                    ->where('arName', '!=', 'Done');
            })->count();
    }

    public function render()
    {
        $query = JobCard::query()
            ->with(['customer', 'car', 'car.model', 'car.type', 'car.brand', 'user', 'status'])
            ->mySearch($this->search)
            ->latest();

        if (\Auth::user()->hasRole('super-admin')) {
            $query->withTrashed();
        }

        if (! is_null($this->jop_status_id)) {
            $query->where('jop_status_id', $this->jop_status_id);
        }

        if ($this->status === 'late') {
            $query->whereDate('dateEntry', '<=', now()->subDays(7))
                ->whereHas('status', function ($q) {
                    $q->where('arName', '!=', 'تم الانتهاء')
                        ->where('arName', '!=', 'Done');
                });
        }

        return view('livewire.jop-cards.jop-crads-page', [
            'jobs' => $query->paginate(10),
            'jobStatus' => JopStatus::query()->withCount('cards')->get(),
        ]);
    }

    public function filterJobCards($jop_status_id)
    {
        $this->jop_status_id = $jop_status_id;
        $this->status = null;
    }

    public function filterLateJobCards()
    {
        $this->jop_status_id = null; // Clear other filters
        $this->status = 'late';
    }

    public function remove($id)
    {
        $this->jobCardId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        $j = JobCard::query()->findOrFail($this->jobCardId);
        try {
            $arr = explode(',', $j->entryImage);
            foreach ($arr as $img) {
                unlink($img);
            }
            $ar = explode(',', $j->exitImage);
            foreach ($ar as $img) {
                unlink($img);
            }
        } catch (Exception $e) {
            //$this->notify('danger', $e->getMessage());
        } finally {
            $j->delete();
        }
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->jobCardId = null;
        $this->reset();
    }

    public function restore($id)
    {
        JobCard::query()->withTrashed()->findOrFail($id)->restore();
        $this->notify('success', trans('public.success'));
    }

    public function forceDelete($id)
    {
        JobCard::query()->where('id', $id)->forceDelete();
        $this->notify('success', trans('public.success'));
    }

    public function viewInvoice($id)
    {
        $car = JobCard::query()->whereId($id)->first()->car;
        $item = Invoice::query()->with('car')->where('job_card_id', $id)->first();
        if ($item) {
            to_route('edit-invoice', $item->id);
        } else {
            to_route('add-invoice', [$car, $id]);
        }
    }
}
