<?php

namespace App\Exceptions;

use Exception;
use \Illuminate\Http\JsonResponse;

class AlreadyAssignedTaskException extends Exception
{
    function render():JsonResponse
    {
        return response()->json(['message' => 'already assigned to another trip'], 409);
    }

    function report():void
    {
        return ;
    }
}
