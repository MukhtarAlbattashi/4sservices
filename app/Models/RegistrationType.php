<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegistrationType extends Model
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

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'registration_type_id','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
