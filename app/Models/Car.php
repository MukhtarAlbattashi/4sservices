<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'owner_id',
        'number',
        'letter',
        'color',
        'year',
        'chassis',
        'serial',
        'cylinders',
        'attach',
        'other',
        'notes',
        'customer_id',
        'car_brand_id',
        'car_model_id',
        'registration_type_id',
        'user_id',
    ];

    public function scopeMySearch($query, $term): void
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('number', 'like', $term)
                ->orWhereHas('customer', function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('phone', 'like', $term);
                });
        });
    }

    public function invoices(): HasMany
    {
        return $this->HasMany(Invoice::class, 'car_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id', 'id');
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RegistrationType::class, 'registration_type_id', 'id');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(JobCard::class, 'car_id', 'id');
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(InvoicePayments::class, Invoice::class);
    }
}
