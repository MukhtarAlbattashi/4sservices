<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseSubCategory extends Model
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
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id','id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public static function getCategorySums()
    {
        if (app()->getLocale() == 'ar') {
            return self::select(['expense_sub_categories.id', 'expense_sub_categories.arName'])
                ->leftJoin('expenses', 'expense_sub_categories.id', '=', 'expenses.expense_sub_category_id')
                ->groupBy('expense_sub_categories.id', 'expense_sub_categories.arName')
                ->selectRaw('SUM(expenses.amount_tax) as expenses_sum_amount')
                ->orderBy('expenses_sum_amount', 'desc')
                ->take(5)
                ->get();
        }
        return self::select(['expense_sub_categories.id', 'expense_sub_categories.enName'])
            ->leftJoin('expenses', 'expense_sub_categories.id', '=', 'expenses.expense_sub_category_id')
            ->groupBy('expense_sub_categories.id', 'expense_sub_categories.enName')
            ->selectRaw('SUM(expenses.amount_tax) as expenses_sum_amount')
            ->orderBy('expenses_sum_amount', 'desc')
            ->take(5)
            ->get();
    }
}
