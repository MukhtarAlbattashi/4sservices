<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'services_total',
        'parts_total',
        'tax',
        'discount',
        'total',
        'date',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('id', 'like', $term);
        });
    }

    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'part_quotation')->withPivot('quantity')->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'quotation_service')->withPivot('quantity')->withTimestamps();
    }

    public function car(): BelongsTo
    {
        return $this->BelongsTo(Car::class, 'car_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customer::class, 'customer_id', 'id');
    }
}
