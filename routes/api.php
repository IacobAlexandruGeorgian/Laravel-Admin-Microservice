<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Checkout\LinkController as CheckoutLinkController;
use App\Http\Controllers\Checkout\OrderController as CheckoutOrderController;
use App\Http\Controllers\Influencer\LinkController;
use App\Http\Controllers\Influencer\ProductController as InfluencerProductController;
use App\Http\Controllers\Influencer\StatsController;
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

Route::prefix('admin')->group(function () {

    Route::get('user', [AuthController::class, 'user']);

    Route::group(['middleware' => 'scope.admin'], function () {

        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('chart', [DashboardController::class, 'chart']);

        Route::post('upload', [ImageController::class, 'upload']);
        Route::get('export', [OrderController::class, 'export']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::post('users', [UserController::class, 'store']);
        Route::put('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);

        Route::get('roles', [RoleController::class, 'index']);
        Route::get('roles/{id}', [RoleController::class, 'show']);
        Route::post('roles', [RoleController::class, 'store']);
        Route::put('roles/{id}', [RoleController::class, 'update']);
        Route::delete('roles/{id}', [RoleController::class, 'destroy']);

        Route::get('products', [ProductController::class, 'index']);
        Route::get('products/{id}', [ProductController::class, 'show']);
        Route::post('products', [ProductController::class, 'store']);
        Route::put('products/{id}', [ProductController::class, 'update']);
        Route::delete('products/{id}', [ProductController::class, 'destroy']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/{id}', [OrderController::class, 'show']);

        Route::get('permissions', [PermissionController::class, 'index']);
    });
});

Route::group(['prefix' => 'influencer'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('products', [InfluencerProductController::class, 'index']);

    Route::group(['middlewre' => 'scope.influencer'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::put('users/info', [AuthController::class, 'updateInfo']);
        Route::put('users/password', [AuthController::class, 'updatePassword']);

        Route::post('links', [LinkController::class, 'store']);
        Route::get('stats', [StatsController::class, 'index']);
        Route::get('rankings', [StatsController::class, 'rankings']);
    });
});

Route::group(['prefix' => 'checkout'], function () {
    Route::get('links/{code}', [CheckoutLinkController::class, 'show']);
    Route::Post('orders', [CheckoutOrderController::class, 'store']);
    Route::Post('orders/confirm', [CheckoutOrderController::class, 'confirm']);
});
