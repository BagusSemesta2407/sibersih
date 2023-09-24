<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityDetail extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    /**
     * Get the activity that owns the ActivityDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get all of the imageActivityDetail for the ActivityDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imageActivityDetail(): HasMany
    {
        return $this->hasMany(ImageActivityDetail::class);
    }

    
}
