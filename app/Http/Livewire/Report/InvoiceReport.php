<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceReport extends Component
{
    public $reports = [];
    public $totalProfits = 0;

    public function mount()
    {
        // Initial query to fetch basic report data
        $this->reports = Invoice::selectRaw('
            MONTH(date) as month,
            COUNT(id) as total_invoices,
            SUM(services_total) as total_services,
            SUM(parts_total) - SUM(parts_total * discount / 100) as total_parts,
            SUM(total) as total_invoice_amount
        ')
            ->whereYear('date', now()->year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();

        // Iterate through each report to calculate profit for parts
        foreach ($this->reports as $report) {
            $month = $report->month;

            $profitForParts = DB::table('invoice_part')
                ->join('invoices', 'invoices.id', '=', 'invoice_part.invoice_id')
                ->join('parts', 'parts.id', '=', 'invoice_part.part_id')
                ->selectRaw('
                SUM((parts.sale_price - parts.purchase_price) * invoice_part.quantity) as profit
            ')
                ->whereRaw('MONTH(invoices.date) = ?', [$month])
                ->whereYear('invoices.date', now()->year)
                ->first();

            $report->profitForParts = $profitForParts->profit ?? 0;
            $report->monthName = date("F", mktime(0, 0, 0, $report->month, 10)); // Convert month number to name
        }
        // Calculate total profits
        $this->totalProfits = $this->reports->sum('profitForParts')+ $this->reports->sum('total_services');

        $this->reports = $this->reports->toArray();
    }



    public function render()
    {
        return view('livewire.report.invoice-report');
    }
}


