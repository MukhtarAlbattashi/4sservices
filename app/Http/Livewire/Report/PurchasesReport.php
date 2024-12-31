<?php

namespace App\Http\Livewire\Report;

use App\Models\Invoice;
use App\Models\InvoicePayments;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PurchasesReport extends Component
{
    public $invoiceItems = [], $invoicesData;
    public $invoiceItems2 = [], $invoicesData2;
    public $amount;
    public $thisWeek;
    public $thisMonth;
    public $lastThreeMonths;
    public $lastSixMonths;
    public $thisYear;
    public $previousYears;
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
        $this->thisWeek = $this->getPurchasesBetweenDates(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $this->thisMonth = $this->getPurchasesBetweenDates(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getPurchasesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getPurchasesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->thisYear = $this->getPurchasesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $this->previousYears = Purchase::query()->sum('total');
        $this->amount = PurchasePayment::query()->sum('amount');
        $this->categorySums = Purchase::getLastFivePurchases();
        $this->subCategorySums = PurchasePayment::getLastFivePurchasePayments();
    }

    private function getPurchasesBetweenDates($start, $end)
    {
        return Purchase::whereBetween('date', [$start, $end])
            ->sum('total');
    }


    public function getBackColors()
    {
        $backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(20, 203, 207, 0.2)',
            'rgba(201, 203, 207, 0.2)',
        ];
        return $backgroundColor;
    }
    public function getBorderColors()
    {
        $borderColor = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(20, 203, 207)',
            'rgb(201, 203, 207)',
        ];
        return $borderColor;
    }

    public function render()
    {
        $this->getPurchaseForAllYears();
        $this->getPurchaseForCurrentYear();
        return view('livewire.report.purchases-report', [
            'invoices' => json_encode($this->invoicesData),
            'invoices2' => json_encode($this->invoicesData2),
        ]);
    }

    public function getPurchaseForAllYears()
    {

        $this->invoiceItems = Purchase::query()
            ->selectRaw('SUM(total) as total')
            ->selectRaw('SUM(discount) as discount')
            ->selectRaw('SUM(tax) as tax')
            ->get()->toArray();
        $objectToArray = json_decode(json_encode($this->invoiceItems[0]), true);
        $amount = $this->amount;
        $objectToArray['amount'] = $this->amount;
        $objectToArray['remine'] = $objectToArray['total'] - $this->amount;
        $totalWithTax = ($objectToArray['tax'] * $objectToArray['total']) / 100;
        $values = [
            $objectToArray['total'],
            $objectToArray['discount'],
            $totalWithTax,
            $objectToArray['amount'],
            $objectToArray['remine'],
        ];
        $names = [
            trans('public.totalAll'),
            trans('public.discount'),
            trans('public.taxAmount'),
            trans('public.paid'),
            trans('public.restAmount'),
        ];
        $borderWidth = 1;
        $this->invoiceItems = $objectToArray;
        $this->invoicesData = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => trans('public.invoices'),
                    'backgroundColor' => $this->getBackColors(),
                    'data' => $values,
                    'borderColor' => $this->getBorderColors(),
                    'borderWidth' => $borderWidth,
                ],

            ],
        ];
    }
    public function getPurchaseForCurrentYear()
    {
        $date = now();
        $this->invoiceItems2 = Purchase::query()
            ->whereBetween('date', [$date->copy()->startOfYear(), $date->copy()->endOfYear()])
            ->selectRaw('SUM(total) as total')
            ->selectRaw('SUM(discount) as discount')
            ->selectRaw('SUM(tax) as tax')
            ->get()->toArray();

        $objectToArray = json_decode(json_encode($this->invoiceItems2[0]), true);
        $amount = PurchasePayment::query()
            ->whereBetween('date', [$date->copy()->startOfYear(), $date->copy()
                ->endOfYear()])->sum('amount');
        $objectToArray['amount'] = $amount;
        $objectToArray['remine'] = $objectToArray['total'] - $amount;
        $totalWithTax = ($objectToArray['tax'] * $objectToArray['total']) / 100;
        $values = [
            $objectToArray['total'],
            $objectToArray['discount'],
            $totalWithTax,
            $objectToArray['amount'],
            $objectToArray['remine'],
        ];
        $names = [
            trans('public.totalAll'),
            trans('public.discount'),
            trans('public.taxAmount'),
            trans('public.paid'),
            trans('public.restAmount'),
        ];
        $borderWidth = 1;
        $this->invoiceItems2 = $objectToArray;
        $this->invoicesData2 = [
            'labels' => $names,
            'datasets' => [
                [
                    'label' => trans('public.invoices'),
                    'backgroundColor' => $this->getBackColors(),
                    'data' => $values,
                    'borderColor' => $this->getBorderColors(),
                    'borderWidth' => $borderWidth,
                ],

            ],
        ];
    }
}
