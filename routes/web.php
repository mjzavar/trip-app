<?php

use Illuminate\Support\Facades\Route;
use App\Enums\ResponseType;

Route::middleware('renderHandler:'.ResponseType::WEB->value)->group(function (){
    include base_path('routes/app.php');
});
