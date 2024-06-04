<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home()
    {
        return ['data' => 'home'];
    }
    function about()
    {
        return ['data' => 'about'];
    }
}
