<?php

namespace App\Http\Livewire\Report;

use App\Models\Invoice;
use App\Models\InvoicePayments;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvoicesPaymentReport extends Component
{
    public $items = [], $data;
    public $items2 = [], $data2;
    public $amount;
    public $thisWeek;
    public $thisMonth;
    public $lastThreeMonths;
    public $lastSixMonths;
    public $thisYear;
    public $previousYears;
    public $categorySums = 0;
    public $subCategorySums = 0;

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

    public function mount(): void
    {
        $this->thisWeek = $this->getInvoicesBetweenDates(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $this->thisMonth = $this->getInvoicesBetweenDates(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getInvoicesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getInvoicesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->thisYear = $this->getInvoicesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $this->previousYears = InvoicePayments::query()->sum('amount');
    }

    private function getInvoicesBetweenDates($start, $end)
    {
        return InvoicePayments::whereBetween('date', [$start, $end])
            ->sum('amount');
    }


    public function getBackColors(): array
    {
        return [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(20, 203, 207, 0.2)',
            'rgba(201, 203, 207, 0.2)',
        ];
    }
    public function getBorderColors(): array
    {
        return [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(20, 203, 207)',
            'rgb(201, 203, 207)',
        ];
    }
    public function render()
    {
        $this->getAllTime();
        $this->currentYear();
        return view('livewire.report.invoices-payment-report', [
            'allYears' => json_encode($this->data),
            'currentYear' => json_encode($this->data2),
        ]);
    }

    public function getAllTime()
    {
        $date = now();
        $this->items = DB::table('invoice_payments')
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
                    'label' => trans('public.paymentsInvoices'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }

    public function currentYear()
    {
        $year = date('Y');
        $this->items2 = DB::table('invoice_payments')
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
                    'label' => trans('public.paymentsInvoices'),
                    'backgroundColor' => $colors,
                    'data' => $values,
                ],

            ],
        ];
    }
}
