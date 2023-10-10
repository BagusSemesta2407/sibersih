<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActivityCategory extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    /**
     * Get all of the activity for the ActivityCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get all of the subangActivity for the ActivityCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subangActivity(): HasMany
    {
        return $this->hasMany(SubangActivity::class);
    }
}
