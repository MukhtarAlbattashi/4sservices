<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'stamp',
        'logo',
        'header',
        'companyNameAr',
        'companyNameEn',
        'CRNo',
        'addressAr',
        'addressEn',
        'governorateAr',
        'governorateEn',
        'wilayatAr',
        'wilayatEn',
        'buildingNo',
        'POBox',
        'pc',
        'email',
        'phone',
        'tax',
        'taxNumber',
        'termsAr',
        'termsEn',
    ];

    protected static function booted()
    {
        static::updated(function ($model) {
            Cache::forget('settings');
        });

        static::created(function ($model) {
            Cache::forget('settings');
        });
    }
}
