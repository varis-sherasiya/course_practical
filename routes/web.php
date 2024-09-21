<?php

use App\Http\Controllers\CommunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/get-states/{country_id}', [CommunController::class, 'getStates'])->name('get.states');
    Route::get('/get-cities/{state_id}', [CommunController::class, 'getCities'])->name('get.cities');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
