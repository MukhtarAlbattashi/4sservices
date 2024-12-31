<?php

namespace App\Http\Livewire\Report;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomersReportPage extends Component
{
    public $items = [];

    public $data;

    public $total = 0;

    public $items2 = [];

    public $data2;

    public $total2 = 0;

    public $thisWeek;

    public $thisMonth;

    public $lastThreeMonths;

    public $lastSixMonths;

    public $thisYear;

    public $previousYears;

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
        $this->thisWeek = $this->getSumExpensesBetweenDates(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $this->thisMonth = $this->getSumExpensesBetweenDates(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getSumExpensesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getSumExpensesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->thisYear = $this->getSumExpensesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $this->previousYears = Customer::query()->count();
    }

    private function getSumExpensesBetweenDates($start, $end)
    {
        return Customer::whereBetween('created_at', [$start, $end])
            ->count();
    }

    public function render()
    {
        $this->getAllTime();
        $this->currentYear();

        return view('livewire.report.customers-report-page', [
            'allYears' => json_encode($this->data),
            'currentYear' => json_encode($this->data2),
        ]);
    }

    public function getAllTime()
    {
        $date = now();
        $this->items = DB::table('customers')
            ->select(DB::raw('MONTHNAME(created_at) as month_name'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [$date->copy()->startOfYear()->subDecade(), $date->copy()->startOfYear()])
            ->groupBy(DB::raw('MONTHNAME(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
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
                    'label' => trans('public.customers'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }

    public function currentYear()
    {
        $year = date('Y');
        $this->items2 = DB::table('customers')
            ->select(DB::raw('MONTHNAME(created_at) as month_name'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->where(DB::raw('YEAR(created_at)'), $year)
            ->groupBy(DB::raw('MONTHNAME(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
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
                    'label' => trans('public.customers'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }
}
