<?php

namespace App\Services;

use App\Exceptions\AlreadyAssignedTaskException;
use App\Models\Task;
use App\Models\Trip;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

class TaskAssignment
{
    private $operationQueue ;
    public function __construct( private readonly Task $task , private readonly Trip $trip)
    {
        $this->operationQueue = collect();
    }



    public function assign()
    {

        if(request()->overwrite == 1 && $this->task->trip )
        {
            $this->operationQueue->push(
                fn() => $this->task->trip()->update(['task_id' => null ])
            );
        }

        $this->operationQueue->push(
            fn() => $this->trip->update(['task_id' => $this->task->id])
        );

        return $this->execute();
    }

    private function execute()
    {
        DB::beginTransaction();
        try
        {
            $results[] = $this->operationQueue->each(
                fn($operation) => $operation()
            );

            DB::commit();
            return $results ;

        }
        catch (UniqueConstraintViolationException $exception )
        {
            DB::rollBack();
            throw new AlreadyAssignedTaskException();
        }
        catch (\Exception $exception )
        {
            DB::rollBack();
            throw $exception;
        }

    }
}
