<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:jwt')->get('me', fn() => new UserResource(Auth::user()));

Route::prefix('auth')->group(function() {
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('plan')->group(function() {
    Route::get('get', [PlanController::class, 'get']);
    Route::middleware(['auth:jwt', 'auth.admin'])->group(function() {
        Route::post('create', [PlanController::class, 'create']);
        Route::patch('update/{id}', [PlanController::class, 'update']);
        Route::delete('delete/{id}', [PlanController::class, 'delete']);
    });
});

Route::prefix('post')->group(function() {
    Route::get('get', [PostController::class, 'get']);
    Route::middleware('auth:jwt')->group(function() {
        Route::post('create', [PostController::class, 'create']);
        Route::patch('update/{id}', [PostController::class, 'update']);
    });
});

Route::middleware('auth:jwt')->get('payment/{plan_id}', [PaymentController::class, 'payment'])
    ->where('plan_id', '\d+');
Route::post('payment/ipn', [PaymentController::class, 'ipn']);
