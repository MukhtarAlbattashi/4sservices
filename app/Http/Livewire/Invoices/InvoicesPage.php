<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class InvoicesPage extends Component
{
    use WithPagination;

    public $search;
    //set three filters for is_paid, all, true, false
    public $isPaid = 'all';

    public $invoiceId;

    public $msgAr;

    public $msgEn;

    public $phone;

    public $uuid;

    public $urlInvoiceWithDetails;

    public $urlInvoiceWithoutDetails;

    protected $paginationTheme = 'bootstrap';

    public function mount(): void
    {
        $this->search = \Request::query('search', '');
        $ms1 = 'عزيزي العميل:';
        $ms2 = ' تم تسجيل الفاتورة بنجاح، ويمكنك الاطلاع عليها من الرابط التالي:';
        $ms3 = ' فريق فور اس سيرفس...';
        $this->msgAr = urlencode($ms1."\n".$ms2."\n".$ms3."\n"."\n");
        $this->msgEn = urlencode("\n"."\n".'Dear customer:'."\n".'The invoice has been registered successfully, and you can view it from the following link:'."\n".'4S Services Team.');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.invoices.invoices-page', [
            'invoices' => Invoice::query()
                ->withTrashed(auth()->user()->hasRole('super-admin'))
                ->when($this->isPaid === 'true', fn($query) => $query->where('is_paid', true))
                ->when($this->isPaid === 'false', fn($query) => $query->where('is_paid', false))
                ->with(['user', 'car.customer', 'car.brand', 'car.model', 'car.type', 'job'])
                ->withSum('payments', 'amount')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function share($data): void
    {
        [$phone, $uuid] = $data;
        $this->phone = $phone;
        $this->uuid = $uuid;
        $this->urlInvoiceWithDetails = 'https://wa.me/968'.$this->phone.'?text='.$this->msgAr.urlencode($this->getInvoiceUrl($this->uuid)).$this->msgEn;
        $this->urlInvoiceWithoutDetails = 'https://wa.me/968'.$this->phone.'?text='.$this->msgAr.urlencode($this->getInvoiceUrlWithoutDetails($this->uuid)).$this->msgEn;
        $this->dispatchBrowserEvent('show-share-model');
    }

    public function getInvoiceUrl($invoice): string
    {
        return route('invoices-details-uuid', $invoice);
    }

    public function getInvoiceUrlWithoutDetails($invoice): string
    {
        return route('invoices-view-uuid', $invoice);
    }

    public function restore($id): void
    {
        Invoice::query()->withTrashed()->findOrFail($id)->restore();
        $this->notify('success', trans('public.success'));
    }

    public function forceDelete($id): void
    {
        Invoice::query()->where('id', $id)->forceDelete();
        $this->notify('success', trans('public.success'));
    }

    public function remove($id): void
    {
        $this->invoiceId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete(): void
    {
        Invoice::query()->findOrFail($this->invoiceId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->invoiceId = null;
        $this->reset();
    }
}
