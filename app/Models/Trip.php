<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo ;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'title' , 'driver_id' , 'truck_id'
    ];

    function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    function truck(): BelongsTo
    {
        return $this->belongsTo(Truck::class);
    }

    function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class , TripTask::class);
    }
}
