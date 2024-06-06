<?php
namespace App\Http\Controllers;
use App\Models\Truck;

class TruckController extends Controller
{
    public function __invoke()
    {
        return Truck::all();
    }
}
