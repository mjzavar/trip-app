<?php
namespace App\Http\Controllers;
use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\TripRequest;
use App\Models\Task;
use App\Models\Trip;
use App\Services\TaskAssignment;

class TripController extends Controller
{
    public function index()
    {
       return Trip::with('driver' , 'truck' , 'tasks')->get();
    }

    function create(TripRequest $request)
    {
        return Trip::create(
            $request->validated()
        );
    }

    function assignTask(AssignTaskRequest $request , Trip $trip  ,Task $task )
    {
        return (
            new TaskAssignment($task , $trip)
        )
            ->run();
    }

}
