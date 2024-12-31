<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'fromDate',
        'toDate',
        'date',
        'startDate',
        'employee',
        'notes',
    ];


    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }

    public function employeeInfo(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(HolidayCategory::class, 'holiday_category_id','id');
    }
}
