<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'services_total',
        'parts_total',
        'tax',
        'discount',
        'total',
        'date',
        'is_paid',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'is_paid' => 'boolean',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('id', 'like', $term)
                ->orWhereHas('customer', function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('phone', 'like', $term);
                });
        });
    }


    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'invoice_part')->withPivot('quantity')->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'invoice_service')->withPivot('quantity')->withTimestamps();
    }

    public function car(): BelongsTo
    {
        return $this->BelongsTo(Car::class, 'car_id', 'id');
    }

    public function job(): BelongsTo
    {
        return $this->BelongsTo(JobCard::class, 'job_card_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customer::class, 'customer_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayments::class, 'invoice_id', 'id')->latest();
    }

}
