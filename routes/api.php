<?php

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

    Route::patch('/tasks/toggle/{task}', [TasksController::class, 'toggle_task']);
    Route::post('/tasks/multiple', [TasksController::class, 'store_multiple']);

    Route::resource('/tasks', TasksController::class);
    Route::resource('/gages', GagesController::class);
    Route::resource('/users', UserController::class);
    Route::post('/group/{partnerCode}', [GroupController::class, 'setGroup']);
    Route::get('/group', [GroupController::class, 'getTheCurrentUserGroup']);

    Route::get('/default_tasks', [DefaultTaskController::class, 'get_all_defaults_tasks']);
    Route::get('/default_gages', [DefaultGageController::class, 'get_all_defaults_gages']);

    //tâches d'administration 
    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'as' => 'admin'], function () {
        Route::get('/default_tasks/{defaultTask}', [DefaultTaskController::class, 'show_default_task']);
        Route::post('/default_tasks', [DefaultTaskController::class, 'store_default_task']);
        Route::patch('/default_tasks/{defaultTask}', [DefaultTaskController::class, 'update_default_task']);
        Route::delete('/default_tasks/{defaultTask}', [DefaultTaskController::class, 'destroy_default_task']);

        Route::get('/default_gages/{defaultGage}', [DefaultGageController::class, 'show_default_gage']);
        Route::post('/default_gages', [DefaultGageController::class, 'store_default_gage']);
        Route::patch('/default_gages/{defaultGage}', [DefaultGageController::class, 'update_default_gage']);
        Route::delete('/default_gages/{defaultGage}', [DefaultGageController::class, 'destroy_default_gage']);

        Route::get('/group/count', [GroupController::class, 'get_total_groups']);
    });
});
