<?php

namespace App\Jobs;

use App\Mail\DailyReportMail;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoicesCount,
        $invoicePayments,
        $customersCount,
        $vehiclesCount,
        $invoicePaymentsByMethods;

    public function __construct($invoicesCount, $invoicePayments, $customersCount, $vehiclesCount, $invoicePaymentsByMethods)
    {
        $this->invoicesCount = $invoicesCount;
        $this->invoicePayments = $invoicePayments;
        $this->customersCount = $customersCount;
        $this->vehiclesCount = $vehiclesCount;
        $this->invoicePaymentsByMethods = $invoicePaymentsByMethods;
    }

    public function handle(): void
    {
        $data = [
            'invoicesCount' => $this->invoicesCount,
            'invoicePayments' => $this->invoicePayments,
            'customersCount' => $this->customersCount,
            'vehiclesCount' => $this->vehiclesCount,
            'invoicePaymentsByMethods' => $this->invoicePaymentsByMethods,
        ];
        Mail::to('mukhtaralbattashi@gmail.com')->send(new DailyReportMail($data));
        //send mail in production to admin user
        if (config('app.env') === 'production') {
            $adminMail= Setting::query()->first()->email;
            if($adminMail){
                Mail::to($adminMail)->send(new DailyReportMail($data));
            }
        }
    }
}
