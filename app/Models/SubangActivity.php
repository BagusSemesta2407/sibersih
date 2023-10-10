<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubangActivity extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    /**
     * Get the activityCategory that owns the SubangActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activityCategory(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class);
    }

    /**
     * Get all of the imageSubangActivity for the SubangActivity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageSubangActivity(): HasMany
    {
        return $this->hasMany(ImageSubangActivity::class);
    }
}
