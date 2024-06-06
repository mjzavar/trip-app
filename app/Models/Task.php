<?php

namespace App\Models;

use App\Enums\TaskFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Task extends Model
{
    use HasFactory;

    function trip():HasOneThrough
    {
        return $this->hasOneThrough(Trip::class , TripTask::class ,'task_id' , 'id' ,'id' , 'trip_id');
    }

    function scopeFilter(Builder $query):void
    {
        $query->when( request('filter') == TaskFilters::ASSIGNED->value    , fn($q) => $q->whereHas('trip'))
              ->when( request('filter') == TaskFilters::NOTASSIGNED->value , fn($q) => $q->whereDoesntHave('trip'));
    }
}
