<?php

namespace App\Http\Livewire\Report;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\IncomeSubCategory;
use Carbon\Carbon;
use DB;
use Livewire\Component;

class IncomeReport extends Component
{
    public $thisWeek;

    public $thisMonth;

    public $lastThreeMonths;

    public $lastSixMonths;

    public $thisYear;

    public $previousYears;

    public $items = [];

    public $data;

    public $total = 0;

    public $items2 = [];

    public $data2;

    public $total2 = 0;

    public $categorySums;

    public $subCategorySums;

    public array $backColors = [
        'rgba(236, 204, 104,0.5)',
        'rgba(123,199,78,0.4)',
        'rgba(255, 127, 80,0.4)',
        'rgba(112, 161, 255,0.4)',
        'rgba(207, 106, 135,0.4)',
        'rgba(56, 173, 169,0.4)',
    ];

    public array $colors = [
        'rgb(229, 142, 38)',
        'rgb(123,199,78)',
        'rgb(255, 127, 80)',
        'rgb(112, 161, 255)',
        'rgb(207, 106, 135)',
        'rgb(7, 153, 146)',
    ];

    public function mount()
    {
        $this->thisWeek = $this->getSumIncomesBetweenDates(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $this->thisMonth = $this->getSumIncomesBetweenDates(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getSumIncomesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getSumIncomesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->thisYear = $this->getSumIncomesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $this->previousYears = Income::query()->sum('amount');
        $this->categorySums = IncomeCategory::getCategorySums();
        $this->subCategorySums = IncomeSubCategory::getCategorySums();
    }

    private function getSumIncomesBetweenDates($start, $end)
    {
        return Income::whereBetween('date', [$start, $end])
            ->sum('amount');
    }

    public function render()
    {
        $this->getAllTime();
        $this->currentYear();

        return view('livewire.report.income-report', [
            'allYears' => json_encode($this->data),
            'currentYear' => json_encode($this->data2),
        ]);
    }

    public function getAllTime()
    {
        $date = now();
        $this->items = DB::table('incomes')
            ->select(DB::raw('MONTHNAME(date) as month_name'), DB::raw('MONTH(date) as month'), DB::raw('SUM(amount) as total'))
            ->whereBetween('date', [$date->copy()->startOfYear()->subDecades(3), $date->copy()->endOfYear()])
            ->groupBy(DB::raw('MONTHNAME(date)'), DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get()->toArray();
        $this->items = json_decode(json_encode($this->items), true);

        $values = [];
        $names = [];
        $this->total = 0;
        $colors = [
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
            '#4b4b4b', '#6ab04c', '#f0932b', '#22a6b3',
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
        ];

        foreach ($this->items as $item) {
            $values[] = $item['total'];
            $names[] = trans('public.'.$item['month_name']);
            $this->total += $item['total'];
        }
        $this->data = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => trans('public.incomes'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }

    public function currentYear()
    {
        $year = date('Y');
        $this->items2 = DB::table('incomes')
            ->select(DB::raw('MONTHNAME(date) as month_name'), DB::raw('MONTH(date) as month'), DB::raw('SUM(amount) as total'))
            ->where(DB::raw('YEAR(date)'), $year)
            ->groupBy(DB::raw('MONTHNAME(date)'), DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('MONTH(date)'))
            ->get()->toArray();
        $this->items2 = json_decode(json_encode($this->items2), true);

        $values = [];
        $names = [];
        $this->total2 = 0;
        $colors = [
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
            '#4b4b4b', '#6ab04c', '#f0932b', '#22a6b3',
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
        ];

        foreach ($this->items2 as $item) {
            $values[] = $item['total'];
            $names[] = trans('public.'.$item['month_name']);
            $this->total2 += $item['total'];
        }
        $this->data2 = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => trans('public.incomes'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }
}
