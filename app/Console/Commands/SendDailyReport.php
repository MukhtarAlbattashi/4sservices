<?php

namespace App\Console\Commands;

use App\Jobs\SendReportJob;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoicePayments;
use Illuminate\Console\Command;

class SendDailyReport extends Command
{
    protected $signature = 'report:daily';
    protected $description = 'Send daily report of invoices and other metrics';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $date = now()->subDay(); // Changed from today to yesterday

        //Invoices count on the specified date
        $invoicesCount = Invoice::whereDate('date', $date)->count() ?? 0;

        $invoicePayments = InvoicePayments::query()
            ->whereDate('date', $date)
            ->sum('amount') ?? 0;

        $customersCount = Customer::query()->whereDate('created_at', $date)->count() ?? 0;

        $vehiclesCount = Car::query()->whereDate('created_at', $date)->count() ?? 0;

        //get invoice payments by payment methods group by payment method name
        $invoicePaymentsByMethods = InvoicePayments::query()
            ->whereDate('date', $date)
            ->with('payment') // Eager load the Payment relationship
            ->get()
            ->groupBy('payment.arName') // Group by the payment method's name
            ->map(function ($payments) {
                return $payments->sum('amount');
            });

        dispatch(new SendReportJob(
            $invoicesCount,
            $invoicePayments,
            $customersCount,
            $vehiclesCount,
            $invoicePaymentsByMethods
        ));
    }
}
