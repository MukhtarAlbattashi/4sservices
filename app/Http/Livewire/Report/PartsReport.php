<?php

namespace App\Http\Livewire\Report;

use App\Models\Expense;
use App\Models\Invoice;
use Carbon\Carbon;
use Livewire\Component;

class PartsReport extends Component
{

    public $monthlyFinancials = [];

    public function mount(): void
    {
        $this->calculateMonthlyFinancials();
    }

    public function render()
    {
        return view('livewire.report.parts-report');
    }

    public function calculateMonthlyFinancials(): void
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];

        foreach ($months as $index => $month) {
            $startOfMonth = now()->startOfYear()->addMonths($index)->startOfMonth();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $invoices = Invoice::whereBetween('date', [$startOfMonth, $endOfMonth])->get();
            $monthlyTotalSales = 0;
            $monthlyTotalPurchases = 0;
            $monthlyTotalRevenueDifference = 0;
            $monthlyTotalQuantity = 0;

            foreach ($invoices as $invoice) {
                foreach ($invoice->parts as $part) {
                    $purchasePrice = $part->purchase_price;
                    $salePrice = $part->sale_price;
                    $quantity = $part->pivot->quantity;

                    $sales = $salePrice * $quantity;
                    $purchases = $purchasePrice * $quantity;
                    $revenueDifference = $sales - $purchases;

                    $monthlyTotalSales += $sales;
                    $monthlyTotalPurchases += $purchases;
                    $monthlyTotalRevenueDifference += $revenueDifference;
                    $monthlyTotalQuantity += $quantity;
                }
            }

            $this->monthlyFinancials[] = [
                'month' => trans('public.'.$month),
                'totalSales' => $monthlyTotalSales,
                'totalPurchases' => $monthlyTotalPurchases,
                'revenueDifference' => $monthlyTotalRevenueDifference,
                'totalQuantity' => $monthlyTotalQuantity,
            ];
        }
    }

}
