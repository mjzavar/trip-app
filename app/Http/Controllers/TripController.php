<?php

namespace App\Http\Controllers;

use App\Models\Trips;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __invoke()
    {
       return Trips::all();
    }
}
