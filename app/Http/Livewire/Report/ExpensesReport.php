<?php

namespace App\Http\Livewire\Report;

use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Component;

class ExpensesReport extends Component
{

    public $thisMonth;

    public $lastThreeMonths;

    public $lastSixMonths;

    public $thisYear;

    public $items2 = [];

    public $data2;

    public $total2 = 0;

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
        $this->thisMonth = $this->getSumExpensesBetweenDates(Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getSumExpensesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(),
            Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getSumExpensesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(),
            Carbon::now()->endOfMonth());
        $this->thisYear = $this->getSumExpensesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
    }

    private function getSumExpensesBetweenDates($start, $end)
    {
        $diffMonths = $start->diffInMonths($end) + 1;
        $nonMonthly = Expense::query()
            ->whereBetween('date', [$start, $end])
            ->where('monthly', '=', false)
            ->sum('amount_tax');
        $monthly = Expense::query()
            ->whereBetween('date', [$start, $end])
            ->where('monthly', '=', true)
            ->sum('amount_tax');
        return $nonMonthly + ($monthly * $diffMonths);
    }


    public function render()
    {
        $this->currentYear();
        return view('livewire.report.expenses-report', [
            'currentYear' => json_encode($this->data2),
        ]);
    }

    public function currentYear(): void
    {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        $names = [];
        $values = [];

        $monthly = Expense::query()
            ->where('monthly', '=', true)
            ->sum('amount_tax');

        foreach ($months as $index => $month) {
            $startOfMonth = now()->startOfYear()->modify($month)->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();
            $totalExpenses = Expense::query()
                ->whereBetween('date', [$startOfMonth, $endOfMonth])
                ->where('monthly', '=', false)
                ->sum('amount_tax');
            $names[] = trans('public.'.$month);
            $values[] = ($totalExpenses + $monthly);
            $this->total2 += ($totalExpenses + $monthly);
            $this->items2[] = trans('public.'.$month).': '.($totalExpenses + $monthly);
        }

        $colors = [
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
            '#4b4b4b', '#6ab04c', '#f0932b', '#22a6b3',
            '#ff6384', '#36a2eb', '#ffce56', '#cc65fe',
        ];

        $this->data2 = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => trans('public.thisYear'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }
}
