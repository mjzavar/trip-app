<?php

use Illuminate\Support\Facades\Route;
use App\Enums\ResponseType;

Route::middleware('renderHandler:' . ResponseType::API->value)->name('api.')->group(function (){
    include base_path('routes/app.php');
});
