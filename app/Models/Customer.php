<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'tax_no',
        'email',
        'identity',
        'address',
        'nationality',
        'note',
    ];

    public function scopeWithRemainingPayments($query)
    {
        $query->addSelect([
            'remaining_payments' =>
                DB::table('invoices')
                    ->selectRaw('COALESCE(SUM(total), 0) -
                (SELECT COALESCE(SUM(amount), 0) FROM invoice_payments WHERE invoice_payments.invoice_id IN
                    (SELECT id FROM invoices WHERE invoices.customer_id = customers.id))')
                    ->whereColumn('invoices.customer_id', 'customers.id')
                    ->groupBy('invoices.customer_id')
        ]);
    }

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('phone', 'like', $term);
        });
    }

    public function cars(): HasMany
    {
        return $this->HasMany(Car::class, 'customer_id', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->HasMany(Invoice::class, 'customer_id', 'id');
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(InvoicePayments::class, Invoice::class);
    }
}
