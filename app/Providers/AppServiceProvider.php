<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Models\JobCard;
use App\Models\Purchase;
use App\Observers\InvoiceObserver;
use App\Observers\JobCardObserver;
use App\Observers\PurchaseObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire\Component::macro('notify', function ($type, $msg) {
            switch ($type) {
                case 'success':
                    $this->dispatchBrowserEvent('success', [
                        'msg' => $msg,
                    ]);
                    break;
                case 'info':
                    $this->dispatchBrowserEvent('info', [
                        'msg' => $msg,
                    ]);
                    break;
                case 'danger':
                    $this->dispatchBrowserEvent('danger', [
                        'msg' => $msg,
                    ]);
                    break;
                default:
                    $this->dispatchBrowserEvent('warning', [
                        'msg' => $msg,
                    ]);
            }
        });
        Model::shouldBeStrict(! $this->app->isProduction());
        Purchase::observe(PurchaseObserver::class);
        JobCard::observe(JobCardObserver::class);
        Invoice::observe(InvoiceObserver::class);
    }
}
