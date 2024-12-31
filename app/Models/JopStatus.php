<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JopStatus extends Model
{
    use HasFactory;


    protected $fillable = [
        'arName',
        'enName',
        'color',
    ];

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('arName', 'like', $term)
                ->orWhere('enName', 'like', $term);
        });
    }

    public function cards(): HasMany
    {
        return $this->hasMany(JobCard::class, 'jop_status_id', 'id');
    }
}
