<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Village extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    /**
     * Get all of the activity for the Village
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
