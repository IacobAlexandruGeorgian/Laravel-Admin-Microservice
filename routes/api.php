<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('chart', [DashboardController::class, 'chart']);

    Route::get('user', [UserController::class, 'user']);
    Route::put('users/info', [UserController::class, 'info']);
    Route::put('users/password', [UserController::class, 'updatePassword']);

    Route::post('upload', [ImageController::class, 'upload']);
    Route::get('export', [OrderController::class, 'export']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::get('roles', [UserController::class, 'index']);
    Route::get('roles/{id}', [UserController::class, 'show']);
    Route::post('roles', [UserController::class, 'store']);
    Route::put('roles/{id}', [UserController::class, 'update']);
    Route::delete('roles/{id}', [UserController::class, 'destroy']);

    Route::get('products', [UserController::class, 'index']);
    Route::get('products/{id}', [UserController::class, 'show']);
    Route::post('products', [UserController::class, 'store']);
    Route::put('products/{id}', [UserController::class, 'update']);
    Route::delete('products/{id}', [UserController::class, 'destroy']);

    Route::get('orders', [UserController::class, 'index']);
    Route::get('orders/{id}', [UserController::class, 'show']);

    Route::get('permissions', [PermissionController::class, 'index']);
});
