<?php

namespace App\Exceptions;

use Exception;

class AlreadyAssignedTaskException extends Exception
{
    function render()
    {
        return response()->json(['message' => 'already assigned to another trip'], 409);
    }
}
