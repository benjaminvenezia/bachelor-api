<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefaultGageController;
use App\Http\Controllers\DefaultTaskController;
use App\Http\Controllers\GagesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/{code}', [UserController::class, 'findUserByCode']);

    Route::resource('/tasks', TasksController::class);
    Route::resource('/default_tasks', DefaultTaskController::class);
    Route::resource('/default_gages', DefaultGageController::class);
    Route::resource('/gages', GagesController::class);
    Route::resource('/users', UserController::class);
    Route::post('/group/{idPartner}', [GroupController::class, 'setGroup']);
    Route::get('/group', [GroupController::class, 'getTheCurrentUserGroup']);

    //tâches d'administration 
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'as' => 'admin'], function () {
        Route::get('/default_tasks/{defaultTask}', [AdminController::class, 'show_default_task']);
        Route::post('/default_tasks', [AdminController::class, 'store_default_task']);
        Route::patch('/default_tasks', [AdminController::class, 'update_default_task']);
        Route::delete('/default_tasks/{defaultTask}', [AdminController::class, 'destroy_default_task']);
    });
});
