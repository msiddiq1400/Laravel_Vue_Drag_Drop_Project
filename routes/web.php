<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('tasks',[TaskController::class, 'showTasks']);
Route::get('update/order', [TaskController::class, 'updateTasksOrder']);
Route::post('/task/update', [TaskController::class, 'updateName']);
Route::post('/task/delete', [TaskController::class, 'deleteTask']);
Route::post('/task/add', [TaskController::class, 'addTask']);