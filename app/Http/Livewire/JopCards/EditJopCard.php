<?php

namespace App\Http\Livewire\JopCards;

use App\Models\Car;
use App\Models\Invoice;
use App\Models\JobCard;
use App\Models\JopStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditJopCard extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $entryImage = [];

    public $exitImage = [];

    public $old_entryImage = [];

    public $old_exitImage = [];

    public $car;

    public $category;

    public $code;

    public $dateEntry;

    public $timeEntry;

    public $dateExit;

    public $timeExit;

    public $whereTheCarCame;

    public $carDriverWhereTheCarCame;

    public $entryCounterNumber;

    public $carRepairPermission;

    public $paintWorks;

    public $dentingWorks;

    public $electricalWorks;

    public $mechanicWorks;

    public $StatusCarOfEntry;

    public $StatusCarOfExit;

    public $departureDestination;

    public $carDriverDeparture;

    public $exitCounterNumber;

    public $jobId;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    public function mount(Car $car, JobCard $job)
    {
        $this->jobId = $job->id;
        $this->car = $car;
        $this->old_entryImage = $job->entryImage == null ? [] : explode(',', $job->entryImage);
        $this->old_exitImage = $job->exitImage == null ? [] : explode(',', $job->exitImage);
        $this->carRepairPermission = $job->carRepairPermission;
        $this->category = $job->jop_status_id;
        $this->dateEntry = $job->dateEntry;
        $this->timeEntry = $job->timeEntry;
        $this->whereTheCarCame = $job->whereTheCarCame;
        $this->carDriverWhereTheCarCame = $job->carDriverWhereTheCarCame;
        $this->entryCounterNumber = $job->entryCounterNumber;
        $this->paintWorks = $job->paintWorks;
        $this->dentingWorks = $job->dentingWorks;
        $this->electricalWorks = $job->electricalWorks;
        $this->mechanicWorks = $job->mechanicWorks;
        $this->StatusCarOfEntry = $job->StatusCarOfEntry;
        $this->StatusCarOfExit = $job->StatusCarOfExit;
        $this->dateExit = $job->dateExit;
        $this->timeExit = $job->timeExit;
        $this->departureDestination = $job->departureDestination;
        $this->carDriverDeparture = $job->carDriverDeparture;
        $this->exitCounterNumber = $job->exitCounterNumber;
    }

    public function render()
    {
        $this->getCategories();

        return view('livewire.jop-cards.edit-jop-card');
    }

    public function getCategories()
    {
        if ($this->categories == null) {
            if (app()->getLocale() == 'ar') {
                $this->categories = JopStatus::pluck('arName', 'id');
            } else {
                $this->categories = JopStatus::pluck('enName', 'id');
            }
        }

        return $this->categories;
    }

    public function updatedEntryImage()
    {
        $this->validate(
            [
                'entryImage.*' => 'mimes:jpg,png',
            ],
            [],
            [
                'entryImage.*' => trans('public.image'),
            ]
        );
    }

    public function updatedExitImage()
    {
        $this->validate(
            [
                'exitImage.*' => 'mimes:jpg,png',
            ],
            [],
            [
                'exitImage.*' => trans('public.image'),
            ]
        );
    }

    public function removeTempExitImage($img)
    {
        unlink($this->old_exitImage[$img]);
        unset($this->old_exitImage[$img]);
        $this->old_exitImage = array_values($this->old_exitImage);
    }

    public function removeTempEntryImage($img)
    {
        unlink($this->old_entryImage[$img]);
        unset($this->old_entryImage[$img]);
        $this->old_entryImage = array_values($this->old_entryImage);
    }

    public function save()
    {
        $jobCard = JobCard::find($this->jobId);
        $jobCard->user_id = Auth::id();
        $jobCard->jop_status_id = $this->category;
        $jobCard->dateEntry = $this->dateEntry;
        $jobCard->timeEntry = $this->timeEntry;
        $jobCard->whereTheCarCame = $this->whereTheCarCame;
        $jobCard->carDriverWhereTheCarCame = $this->carDriverWhereTheCarCame;
        $jobCard->entryCounterNumber = $this->entryCounterNumber;
        $jobCard->paintWorks = $this->paintWorks;
        $jobCard->dentingWorks = $this->dentingWorks;
        $jobCard->electricalWorks = $this->electricalWorks;
        $jobCard->mechanicWorks = $this->mechanicWorks;
        $jobCard->StatusCarOfEntry = $this->StatusCarOfEntry;
        $jobCard->StatusCarOfExit = $this->StatusCarOfExit;
        $jobCard->dateExit = $this->dateExit;
        $jobCard->timeExit = $this->timeExit;
        $jobCard->departureDestination = $this->departureDestination;
        $jobCard->carDriverDeparture = $this->carDriverDeparture;
        $jobCard->exitCounterNumber = $this->exitCounterNumber;
        if ($this->carRepairPermission != null && $this->carRepairPermission != $jobCard->carRepairPermission) {
            $path = $this->carRepairPermission->store('photo', 'public');
            $jobCard->carRepairPermission = 'storage/'.$path;
        }
        $paths = [];
        if (! empty($this->entryImage)) {
            foreach ($this->entryImage as $image) {
                if (! file_exists($image)) {
                    $path = $image->store('photo', 'public');
                    $paths[] = 'storage/'.$path;
                }
            }
            $o = implode(',', $this->old_entryImage);
            $p = implode(',', $paths);
            $jobCard->entryImage = $p.','.$o;
        } else {
            $jobCard->entryImage = implode(',', $this->old_entryImage);
        }
        $paths = [];
        if (! empty($this->exitImage)) {
            foreach ($this->exitImage as $image) {
                if (! file_exists($image)) {
                    $path = $image->store('photo', 'public');
                    $paths[] = 'storage/'.$path;
                }
            }
            $o = implode(',', $this->old_exitImage);
            $p = implode(',', $paths);
            $jobCard->exitImage = $p.','.$o;
        } else {
            $jobCard->exitImage = implode(',', $this->old_exitImage);
        }
        $jobCard->save();
        $this->notify('success', trans('public.success'));
        to_route('jop-cards-view');
    }

    public function viewInvoice()
    {
        $item = Invoice::query()->where('job_card_id', $this->jobId)->first();
        if ($item) {
            to_route('edit-invoice', $item->id);
        } else {
            to_route('add-invoice', [$this->car, $this->jobId]);
        }
    }
}
