<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'traineeAr',
        'traineeEn',
        'email',
        'phone',
        'idNumber',
        'jobName',
        'gender',
        'nationality',
        'religion',
        'status',
        'address',
        'academicQualification',
        'typeAcademic',
        'dateAcademic',
        'placeAcademic',
        'trainingDepartment',
        'trainingDuration',
        'trainingSalary',
        'startTrainingDate',
        'endTrainingDate',
        'trainingPlace',
        'attendTraining',
        'managementSkills',
        'technicalSkills',
        'evaluationTrainee',
        'image',
        'notes',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('traineeAr', 'like', $term)
                ->orWhere('traineeEn', 'like', $term)
                ->orWhere('email', 'like', $term);
        });
    }
}
