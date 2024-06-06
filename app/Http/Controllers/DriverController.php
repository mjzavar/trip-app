<?php

namespace App\Http\Controllers;

use App\Models\Driver;

class DriverController extends Controller
{
    public function __invoke()
    {
        return Driver::all();
    }
}
