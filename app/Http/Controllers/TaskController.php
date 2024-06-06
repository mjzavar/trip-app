<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function __invoke()
    {
        return Task::with('trip')
            ->filter()
            ->latest()
            ->get();
    }
}
