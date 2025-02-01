<?php

namespace App\Http\Livewire\Report;

use App\Models\Allowance;
use App\Models\Asset;
use App\Models\Contract;
use App\Models\Discount;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\InvoicePayments;
use App\Models\Loan;
use App\Models\PurchasePayment;
use App\Models\Salary;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SummaryReport extends Component
{
    //expenses
    public $totalContracts;
    public $totalSalaries;
    public $totalExpenses;
    public $totalAllowances;
    public $totalAssets;
    public $totalPurchase;
    public $totalLoans;
    public $totalAllOfExpenses;

    //incomes
    public $totalServices;
    public $profitForParts;
    public $totalDiscount;
    public $totalInvoicesPayment;
    public $totalIncomes;
    public $totalInvoicesRimine;
    public $totalAllOfIncomes;

    public $profit;

    public function mount(): void
    {
        $this->calculateExpanses();
        $this->calculateIncomes();
        $this->profit = $this->totalAllOfIncomes - $this->totalAllOfExpenses;
        $this->calculateProfitFromInvoicesServicesAndParts();
    }

    public function calculateIncomes(): void
    {
        $this->totalDiscount = Discount::query()->whereBetween('date',
            [now()->firstOfMonth(), now()->endOfMonth()])->sum('amount');
        $this->totalIncomes = Income::query()->whereBetween('date',
            [now()->firstOfMonth(), now()->endOfMonth()])->sum('amount');

        // Get invoices for the current month
        $invoices = Invoice::with('payments') // eager load payments related to the invoices
        ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get();

        // Calculate the total invoice amount for the current month
        $totalInvoicesAmount = $invoices->sum('total');

        // Calculate total payments made for these invoices
        $totalPayments = $invoices->reduce(function ($carry, $invoice) {
            return $carry + $invoice->payments->sum('amount');
        }, 0);

        // Calculate the total amount of invoices that are not paid yet
        $this->totalInvoicesRimine = $totalInvoicesAmount - $totalPayments;

        // Calculate the total amount of payments made for invoices
        $this->totalInvoicesPayment = $totalPayments;

        $this->totalAllOfIncomes = $this->totalDiscount +
            $this->totalInvoicesPayment +
            $this->totalIncomes +
            $this->totalInvoicesRimine;
    }

    private function calculateExpanses(): void
    {
        $this->totalContracts = $this->getSumOfContracts();
        $this->totalSalaries = $this->getSumOfSalaries();
        $this->totalExpenses = $this->getSumOfExpenses();
        $this->totalAllowances = $this->getSumOfAllowances();
        $this->totalAssets = $this->getSumOfAssets();
        $this->totalPurchase = $this->getSumOfPurchasePayments();
        $this->totalLoans = $this->getSumOfLoans();

        $this->totalAllOfExpenses = $this->totalExpenses +
            $this->totalAllowances + $this->totalAssets +
            $this->totalPurchase + $this->totalLoans+
            $this->totalSalaries + $this->totalContracts;
    }

    public function render(
    ): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.report.summary-report');
    }

    //get sum of totalSalary a valid contracts for current month
    private function getSumOfContracts()
    {
        return Contract::query()
            ->where('startDateContract', '<=', now())
            ->where('endDateContract', '>=', now())
            ->sum('totalSalary');
    }

    //get total salaries for current month
    private function getSumOfSalaries()
    {
        return Salary::query()
            ->sum('amount');
    }

    //get total expenses for current month
    private function getSumOfExpenses()
{
    // Get the current month and year
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Get monthly expenses sum
    $monthlyExpenses = Expense::query()
        ->where('monthly', true)
        ->sum('amount_tax');

    // Get non-monthly expenses sum for the current month and year
    $nonMonthlyExpenses = Expense::query()
        ->whereMonth('date', $currentMonth)
        ->whereYear('date', $currentYear) // Ensuring the same year
        ->where('monthly', false)
        ->sum('amount_tax');

    return $monthlyExpenses + $nonMonthlyExpenses;
}

    //get total allowances for current month
    private function getSumOfAllowances()
    {
        return Allowance::query()
            ->whereBetween('date', [now()->firstOfMonth(), now()->endOfMonth()])
            ->sum('amount');

    }

    //get total assets for current month
    private function getSumOfAssets(): float|int
    {
        $assets = Asset::query()->whereBetween('date', [now()->startOfYear(), now()->endOfYear()])->get();
        foreach ($assets as $asset) {
            $this->totalAssets += $this->calculateMonthlyInstallment($asset->amount, $asset->rate);
        }
        return $this->totalAssets ?? 0;
    }

    public function calculateMonthlyInstallment($amount, $depreciationRate): float|int
    {
        $monthlyRate = $depreciationRate / (100 * 12);

        return $amount * $monthlyRate;
    }

    //get total purchase for current month
    private function getSumOfPurchasePayments()
    {
        return PurchasePayment::query()
            ->whereBetween('date', [now()->firstOfMonth(), now()->endOfMonth()])
            ->sum('amount');
    }

    //get total loans for current month
    private function getSumOfLoans()
    {
        return Loan::query()
            ->where('from', '<=', now())
            ->where('to', '>=', now())
            ->where('active', true)
            ->sum('amount');
    }

    //get total profit for current month
    public function calculateProfitFromInvoicesServicesAndParts(): void
    {
        // Define current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Fetch the sum totals for the current month
        $report = Invoice::selectRaw('
        SUM(services_total) as total_services,
        SUM(parts_total) - SUM(parts_total * discount / 100) as total_parts,
        SUM(total) as total_invoice_amount
    ')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->first();

        if ($report) {
            // Calculate profit for parts for the current month
            $profitForParts = DB::table('invoice_part')
                ->join('invoices', 'invoices.id', '=', 'invoice_part.invoice_id')
                ->join('parts', 'parts.id', '=', 'invoice_part.part_id')
                ->selectRaw('SUM((parts.sale_price - parts.purchase_price) * invoice_part.quantity) as profit')
                ->whereMonth('invoices.date', $currentMonth)
                ->whereYear('invoices.date', $currentYear)
                ->first();

            // Assign values to component properties
            $this->profitForParts = $profitForParts->profit ?? 0;
            $this->totalServices = $report->total_services;

            // Now $this->profitForParts and $this->totalServices are available for use within your Livewire component
        } else {
            // Set defaults in case no data is found
            $this->profitForParts = 0;
            $this->totalServices = 0;
        }
    }
}
