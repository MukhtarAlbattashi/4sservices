<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_total',
        'tax',
        'discount',
        'total',
        'date',
    ];

    public static function getLastFivePurchases()
    {
        return self::orderBy('date', 'desc')
            ->with('supplier')
            ->take(5)
            ->get();
    }

    public function scopeMySearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('id', 'like', $term);
        });
    }

    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'part_purchase')->withPivot('quantity')->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(PurchasePayment::class, 'purchase_id', 'id')->latest();
    }
}
