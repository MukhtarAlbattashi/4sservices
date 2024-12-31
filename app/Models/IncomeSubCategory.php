<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomeSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'arName',
        'enName',
    ];
    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('arName', 'like', $term)
                ->orWhere('enName', 'like', $term);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id','id');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    // app/Models/IncomeCategory.php

    public static function getCategorySums()
    {
        if (app()->getLocale() == 'ar') {
            return self::select(['income_sub_categories.id', 'income_sub_categories.arName'])
                ->leftJoin('incomes', 'income_sub_categories.id', '=', 'incomes.income_sub_category_id')
                ->groupBy('income_sub_categories.id', 'income_sub_categories.arName')
                ->selectRaw('SUM(incomes.amount) as incomes_sum_amount')
                ->orderBy('incomes_sum_amount', 'desc')
                ->take(5)
                ->get();
        }
        return self::select(['income_sub_categories.id', 'income_sub_categories.enName'])
        ->leftJoin('incomes', 'income_sub_categories.id', '=', 'incomes.income_sub_category_id')
        ->groupBy('income_sub_categories.id', 'income_sub_categories.enName')
        ->selectRaw('SUM(incomes.amount) as incomes_sum_amount')
        ->orderBy('incomes_sum_amount', 'desc')
        ->take(5)
        ->get();
    }
}
