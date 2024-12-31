<?php

namespace App\Http\Livewire\Report;

use App\Models\Invoice;
use App\Models\InvoicePayments;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvoicesReport extends Component
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

    public function mount()
    {
        $this->thisWeek = $this->getInvoicesBetweenDates(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $this->thisMonth = $this->getInvoicesBetweenDates(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastThreeMonths = $this->getInvoicesBetweenDates(Carbon::now()->subMonths(2)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->lastSixMonths = $this->getInvoicesBetweenDates(Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth());
        $this->thisYear = $this->getInvoicesBetweenDates(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $this->previousYears = Invoice::query()->sum('total');
        $this->amount = InvoicePayments::query()->sum('amount');

    }

    private function getInvoicesBetweenDates($start, $end)
    {
        return Invoice::whereBetween('date', [$start, $end])
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
        $this->getCustomersBillingInfo();
        $this->getInvoicesThisYear();
        //dd($this->invoiceItems2);
        return view('livewire.report.invoices-report', [
            'invoices' => json_encode($this->invoicesData),
            'invoices2' => json_encode($this->invoicesData2),
        ]);
    }



    public function getCustomersBillingInfo()
    {

        $this->invoiceItems = Invoice::query()
            ->selectRaw('SUM(total) as total')
            ->selectRaw('SUM(discount) as discount')
            ->selectRaw('SUM(services_total) as services_total')
            ->selectRaw('SUM(parts_total) as parts_total')
            ->selectRaw('SUM(tax) as tax')
            ->get()->toArray();
        $objectToArray = json_decode(json_encode($this->invoiceItems[0]), true);
        $amount = InvoicePayments::query()->sum('amount');
        $objectToArray['amount'] = $amount;
        $objectToArray['remine'] = $objectToArray['total'] - $this->amount;
        $objectToArray['tax'] = $objectToArray['tax'] * $objectToArray['total'] /100;
        $values = [
            $objectToArray['discount'],
            $objectToArray['services_total'],
            $objectToArray['parts_total'],
            $objectToArray['tax'],
            $objectToArray['amount'],
            $objectToArray['remine'],
        ];
        $names = [
            trans('public.discount'),
            trans('public.subTotalService'),
            trans('public.subTotalParts'),
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
    public function getInvoicesThisYear()
    {
        $date = now();
        $this->invoiceItems2 = Invoice::query()
            ->whereBetween('date', [$date->copy()->startOfYear(), $date->copy()->endOfYear()])
            ->selectRaw('SUM(total) as total')
            ->selectRaw('SUM(discount) as discount')
            ->selectRaw('SUM(services_total) as services_total')
            ->selectRaw('SUM(parts_total) as parts_total')
            ->selectRaw('SUM(tax) as tax')
            ->get()->toArray();

        $objectToArray = json_decode(json_encode($this->invoiceItems2[0]), true);
        $amount = InvoicePayments::query()
            ->whereBetween('date', [$date->copy()->startOfYear(), $date->copy()
                ->endOfYear()])->sum('amount');
        $objectToArray['amount'] = $amount;
        $objectToArray['remine'] = $objectToArray['total'] - $amount;
        $objectToArray['tax'] = $objectToArray['tax'] * $objectToArray['total'] /100;
        $values = [
            $objectToArray['discount'],
            $objectToArray['services_total'],
            $objectToArray['parts_total'],
            $objectToArray['tax'],
            $objectToArray['amount'],
            $objectToArray['remine'],
        ];
        $names = [
            trans('public.discount'),
            trans('public.subTotalService'),
            trans('public.subTotalParts'),
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
