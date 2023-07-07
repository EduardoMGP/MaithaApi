<?php

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

Route::group(['prefix' => 'auth', 'controller' => \App\Http\Controllers\AuthController::class], function () {
    Route::post('login', 'login')->name('api.login');
    Route::post('register', 'register')->name('api.register');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('me', 'validateToken')->name('api.validateToken');
        Route::post('logout', 'logout')->name('api.logout');
        Route::post('logout-all', 'logoutAll')->name('api.logout.all');
    });
});

Route::group(
    [
        'prefix' => 'users',
        'controller' => \App\Http\Controllers\UserController::class,
        'middleware' => 'auth:sanctum'
    ], function () {
    Route::get('/', 'index');
    Route::post('/', 'create')->name('api.user.create');
    Route::get('/{user}', 'show');
    Route::put('/{user}', 'update')->name('api.user.update');
    Route::delete('/{user}', 'delete');
});
