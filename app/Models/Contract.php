<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractName',
        'jobNameAr',
        'jobNameEn',
        'contractDuration',
        'startDateContract',
        'endDateContract',
        'dateContract',
        'basicSalary',
        'costOfLivingAllowance',
        'foodAllowance',
        'transferAllowance',
        'overtime',
        'housingAllowance',
        'phoneAllowance',
        'otherAllowance',
        'medical',
        'socialInsuranceDiscount',
        'totalSalary',
        'contractTermsAr',
        'contractTermsEn',
        'notes',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('jobNameAr', 'like', $term)
                ->orWhere('jobNameEn', 'like', $term)
                ->orWhere('contractName', 'like', $term);
        });
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
