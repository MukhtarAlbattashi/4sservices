<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllowanceCategory extends Model
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

    public function allowances(): HasMany
    {
        return $this->hasMany(Allowance::class, 'allowance_category_id');
    }
}
