<?php

use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\Task\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::apiResource('/projects', ProjectController::class);
Route::apiResource('/tasks', TaskController::class);

