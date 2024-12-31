<?php

namespace App\Http\Livewire\JopCards;

use App\Models\Car;
use App\Models\JobCard;
use App\Models\JopStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddJopCard extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $entryImage = [];

    public $exitImage = [];

    public $car;

    public $category;

    public $code;

    public $dateEntry;

    public $timeEntry;

    public $dateExit;

    public $timeExit;

    public $whereTheCarCame = 'خصوصي / private';

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

    public $active = false;

    public $cardId;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    public function mount(Car $car)
    {
        $this->car = $car;
        $this->getCategories();
        $this->category = $this->categories->keys()->first() ?? null;
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

    public function render()
    {
        $this->dateEntry = date('Y-m-d', strtotime(now()));
        $this->timeEntry = now()->addHours(4)->format('H:i');
        $this->dateExit = date('Y-m-d', strtotime(now()));
        $this->timeExit = now()->addHours(4)->format('H:i');

        return view('livewire.jop-cards.add-jop-card');
    }

    public function updatedEntryImage()
    {
        $this->validate(
            [
                'entryImage.*' => 'mimes:jpg,png|max:1024',
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
                'exitImage.*' => 'mimes:jpg,png|max:1024',
            ],
            [],
            [
                'exitImage.*' => trans('public.image'),
            ]
        );
    }

    public function removeExitImage($img)
    {
        unset($this->exitImage[$img]);
        $this->exitImage = array_values($this->exitImage);
    }

    public function removeEntryImage($img)
    {
        unset($this->entryImage[$img]);
        $this->entryImage = array_values($this->entryImage);
    }

    public function save()
    {
        if ($this->active) {
            return;
        }
        $this->setValidation();
        $job = new JobCard();
        $job->user_id = Auth::id();
        $job->customer_id = $this->car->customer->id;
        $job->car_id = $this->car->id;
        $job->fill([
            'jop_status_id' => $this->category,
            'dateEntry' => $this->dateEntry,
            'timeEntry' => $this->timeEntry,
            'whereTheCarCame' => $this->whereTheCarCame,
            'carDriverWhereTheCarCame' => $this->carDriverWhereTheCarCame,
            'entryCounterNumber' => $this->entryCounterNumber,
            'paintWorks' => $this->paintWorks,
            'dentingWorks' => $this->dentingWorks,
            'electricalWorks' => $this->electricalWorks,
            'mechanicWorks' => $this->mechanicWorks,
            'StatusCarOfEntry' => $this->StatusCarOfEntry,
            'StatusCarOfExit' => $this->StatusCarOfExit,
            'dateExit' => $this->dateExit,
            'timeExit' => $this->timeExit,
            'departureDestination' => $this->departureDestination,
            'carDriverDeparture' => $this->carDriverDeparture,
            'exitCounterNumber' => $this->exitCounterNumber,
        ]);
        if ($this->carRepairPermission) {
            $path = $this->carRepairPermission->store('photo', 'public');
            $job->carRepairPermission = 'storage/'.$path;
        }
        $paths = [];
        if (! empty($this->entryImage)) {
            foreach ($this->entryImage as $image) {
                $path = $image->store('photo', 'public');
                $paths[] = 'storage/'.$path;
            }
            $job->entryImage = implode(',', $paths);
        }
        $paths = [];
        if (! empty($this->exitImage)) {
            foreach ($this->exitImage as $image) {
                $path = $image->store('photo', 'public');
                $paths[] = 'storage/'.$path;
            }
            $job->exitImage = implode(',', $paths);
        }
        $job->save();
        $this->notify('success', trans('public.success'));
        $this->active = true;
        $this->cardId = $job->id;
    }

    public function setValidation()
    {
        $this->validate(
            [
                'category' => 'required',
                'dateEntry' => 'required',
                'timeEntry' => 'required',
                'whereTheCarCame' => 'required',
                'carDriverWhereTheCarCame' => 'required|string|max:250',
                'entryCounterNumber' => 'required|numeric|min:0',
                'paintWorks' => 'nullable|string|max:16777000',
                'dentingWorks' => 'nullable|string|max:16777000',
                'electricalWorks' => 'nullable|string|max:16777000',
                'mechanicWorks' => 'nullable|string|max:16777000',
                'StatusCarOfEntry' => 'nullable|string|max:16777000',
                'StatusCarOfExit' => 'nullable|string|max:16777000',
                'dateExit' => 'required',
                'timeExit' => 'required',
                'departureDestination' => 'nullable|string|max:250',
                'carDriverDeparture' => 'nullable|string|max:250',
                'exitCounterNumber' => 'nullable|numeric|min:0',
            ],
            [],
            [
                'dateEntry' => trans('public.dateEntry'),
                'timeEntry' => trans('public.timeEntry'),
                'whereTheCarCame' => trans('public.whereTheCarCame'),
                'carDriverWhereTheCarCame' => trans('public.carDriverWhereTheCarCame'),
                'entryCounterNumber' => trans('public.entryCounterNumber'),
                'paintWorks' => trans('public.paintWorks'),
                'dentingWorks' => trans('public.dentingWorks'),
                'electricalWorks' => trans('public.electricalWorks'),
                'mechanicWorks' => trans('public.mechanicWorks'),
                'StatusCarOfEntry' => trans('public.StatusCarOfEntry'),
                'StatusCarOfExit' => trans('public.StatusCarOfExit'),
                'dateExit' => trans('public.dateExit'),
                'timeExit' => trans('public.timeExit'),
                'departureDestination' => trans('public.departureDestination'),
                'carDriverDeparture' => trans('public.carDriverDeparture'),
                'exitCounterNumber' => trans('public.exitCounterNumber'),
            ]
        );
    }
}
