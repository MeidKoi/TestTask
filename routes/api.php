<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/users/{id}', 'show');
    Route::post('/users', 'store');
    Route::patch('/users/{user}', 'update');
});

Route::controller(GroupController::class)->group(function () {
    Route::get('/groups/{id}', 'show');
    Route::post('/groups', 'store');
    Route::patch('/groups/{group}', 'update');
});
