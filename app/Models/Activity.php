<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    /**
     * Get the activityCategory that owns the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activityCategory(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class);
    }

    /**
     * Get the village that owns the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    /**
     * Get all of the imageActivity for the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageActivity(): HasMany
    {
        return $this->hasMany(ImageActivity::class);
    }

    /**
     * Get all of the activityDetail for the Activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activityDetail(): HasMany
    {
        return $this->hasMany(ActivityDetail::class);
    }

    /**
     * Scope Filter
     *
     * @return scope
     */
    public function scopeFilter($query, object $filter)
    {
        $query->when($filter->village_id ?? false, fn($q, $villageId) => $q->where('village_id', $villageId));
        $query->when($filter->startDate ?? false, fn($q, $startDate) => $q->where('date', '>=', $startDate)); 
        $query->when($filter->endDate ?? false, fn($q, $endDate) => $q->where('date', '<=', $endDate)); 
    }
}
