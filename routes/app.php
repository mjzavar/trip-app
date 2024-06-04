<?php
use Illuminate\Support\Facades\Route;
USE \App\Http\Controllers\{
    HomeController , TruckController , TaskController , TripController , DriverController
};
Route::get('/' , [HomeController::class , 'home'])->name('home');
Route::get('/about' , [HomeController::class , 'about'])->name('about');

Route::prefix('trucks')->controller(TruckController::class)->group(function () {
    Route::get('/')->name('trucks');
});

Route::prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('/')->name('tasks');
});

Route::prefix('trips')->controller(TripController::class)->group(function () {
    Route::get('/')->name('trips');
});

Route::prefix('drivers')->controller(DriverController::class)->group(function () {
    Route::get('/')->name('drivers');
});
