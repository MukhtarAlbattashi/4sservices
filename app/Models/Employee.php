<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'employeeNumber',
        'joinDate',
        'employeeNameAr',
        'employeeNameEn',
        'email',
        'phone',
        'password',
        'jopNameAr',
        'jopNameEn',
        'birthDate',
        'gender',
        'nationality',
        'religion',
        'socialStatus',
        'idNumber',
        'dateOfIssue',
        'expiryDate',
        'passportNumber',
        'passportDateOfIssue',
        'passportExpiryDate',
        'placeOfIssue',
        'academicQualification',
        'typeAcademic',
        'dateAcademic',
        'placeAcademic',
        'address',
        'image',
        'notes',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('employeeNameAr', 'like', $term)
                ->orWhere('employeeNameEn', 'like', $term)
                ->orWhere('email', 'like', $term);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EmployeeCategory::class, 'employee_category_id','id');
    }
    public function holiday(): BelongsTo
    {
        return $this->belongsTo(HolidayCategory::class, 'employee_category_id','id');
    }
}
