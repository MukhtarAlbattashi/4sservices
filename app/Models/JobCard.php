<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dateEntry',
        'timeEntry',
        'whereTheCarCame',
        'carDriverWhereTheCarCame',
        'entryCounterNumber',
        'carRepairPermission',
        'entryImage',
        'paintWorks',
        'dentingWorks',
        'electricalWorks',
        'mechanicWorks',
        'StatusCarOfEntry',
        'StatusCarOfExit',
        'dateExit',
        'timeExit',
        'departureDestination',
        'carDriverDeparture',
        'exitCounterNumber',
        'exitImage',
        'customer_id',
        'car_id',
        'jop_status_id',
        'user_id',
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

    public function status(): BelongsTo
    {
        return $this->belongsTo(JopStatus::class, 'jop_status_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
