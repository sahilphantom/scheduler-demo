<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/posts', [PostController::class, 'index']);
});

Route::get('/api/active-users', [UserController::class, 'activeUsers']);