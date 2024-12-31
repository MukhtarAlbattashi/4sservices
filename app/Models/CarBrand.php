<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class CarBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'arName',
        'enName',
        'image',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('arName', 'like', $term)
                ->orWhere('enName', 'like', $term);
        });
    }

    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class, 'car_brand_id');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'car_brand_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // CarBrand.php

    public static function getTopBrandsWithCounts()
    {
        return self::select('car_brands.id', 'arName', 'enName', DB::raw('COUNT(cars.id) as car_count'))
            ->join('cars', 'car_brands.id', '=', 'cars.car_brand_id')
            ->groupBy('car_brands.id', 'car_brands.arName', 'car_brands.enName')
            ->orderBy('car_count', 'DESC')
            ->limit(5)
            ->get();
    }
}
