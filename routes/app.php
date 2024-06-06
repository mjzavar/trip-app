<?php
use Illuminate\Support\Facades\Route;
USE \App\Http\Controllers\{
     TruckController , TaskController , TripController , DriverController
};
Route::get('/' , fn()=> [] )->name('home');

Route::prefix('trucks')->group(function () {
    Route::get('/'  , TruckController::class)->name('trucks');
});

Route::prefix('tasks')->group(function () {
    Route::get('/' , TaskController::class )->name('tasks');
});


Route::prefix('drivers')->group(function () {
    Route::get('/' , DriverController::class)->name('drivers');
});


Route::prefix('trips')->controller(TripController::class)->group(function () {
    Route::get('/' , 'index')->name('trips');
    Route::post('/' , 'create')->name('trips.create');
    Route::patch('/{trip}/{task}' , 'assignTask')->name('trips.tasks.assign');
});
