<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Project\ModuleController;
use App\Http\Controllers\Project\PageController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectResourceController;
use App\Http\Controllers\Resources\DepartmentController;
use App\Http\Controllers\Resources\DesignationController;
use App\Http\Controllers\Resources\ResourceController;
use App\Http\Controllers\Resources\SkillController;
use App\Http\Controllers\Task\MyPendingTaskController;
use App\Http\Controllers\Task\TaskController;
use App\Models\Task\TaskMovementTracking;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::resource('/department',DepartmentController::class);
    Route::resource('/designaiton', DesignationController::class);
    Route::resource('/skill', SkillController::class);
    Route::resource('/resource', ResourceController::class);
    Route::resource('/project', ProjectController::class);
    Route::resource('/project-resources', ProjectResourceController::class);
    Route::resource('/module', ModuleController::class);
    Route::resource('/page', PageController::class);
    // task assign
    Route::get('/task-publish/{id}', [TaskController::class, 'publish']);
    Route::post('/task-assign', [TaskController::class, 'assignUser']);
    Route::resource('/task', TaskController::class);
    //pending task
    Route::resource('/pending-task', MyPendingTaskController::class);
    Route::post('/task-tracking/start-time', [TaskMovementTracking::class, 'startTime']);
    Route::resource('/task-tracking', TaskMovementTracking::class);
});
