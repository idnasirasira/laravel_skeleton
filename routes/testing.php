<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// For Testing Download
Route::get('/user/download/{type?}', [UserController::class, 'export']);

// For testing Roles
Route::get('/user/secret', function (Request $request) {
    return 'Secret View For Admin Only';
})->middleware('role:admin');
