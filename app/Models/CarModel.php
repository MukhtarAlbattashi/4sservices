<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'arName',
        'enName',
        'image',
        'car_brand_id',
    ];

    public static function getTopModelsWithCounts()
    {
        return self::select('car_models.id', 'arName', 'enName', DB::raw('COUNT(cars.id) as car_count'))
            ->join('cars', 'car_models.id', '=', 'cars.car_model_id')
            ->groupBy('car_models.id', 'car_models.arName', 'car_models.enName')
            ->orderBy('car_count', 'DESC')
            ->limit(5)
            ->get();
    }

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('arName', 'like', $term)
                ->orWhere('enName', 'like', $term);
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id', 'id');
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'car_model_id', 'id');
    }

    // CarModel.php

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
