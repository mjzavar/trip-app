<?php

namespace App\Services;

use App\Exceptions\AlreadyAssignedTaskException;
use App\Models\Task;
use App\Models\Trip;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

class TaskAssignment extends  DbQueueWorker
{
    public function __construct( private readonly Task $task , private readonly Trip $trip)
    {
        Parent::__construct();
    }

    public function run()
    {
        if(request()->overwrite == 1 && $this->task->trip )
        {
            $this->push(
                fn() => $this->task->trip->tasks()->detach($this->task)
            );
        }

        $this->push(
            fn() => $this->trip->tasks()->attach($this->task)
        );

        try
        {
            return $this->execute();
        }
        catch (UniqueConstraintViolationException $exception )
        {
            throw new AlreadyAssignedTaskException();
        }


    }

}
