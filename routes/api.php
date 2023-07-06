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

Route::group(['prefix' => 'auth'], function () {

    $AuthController = \App\Http\Controllers\AuthController::class;

    Route::post('login', $AuthController . '@login')->name('login');
    Route::post('register', $AuthController . '@register')->name('register');
    Route::group(['middleware' => 'auth:api'], function() use ($AuthController) {
        Route::get('logout', $AuthController . '@logout')->name('logout');
        Route::get('user', $AuthController . '@user')->name('user');
    });
});

Route::group([], function() {
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('users/{user}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::put('users/{user}', 'UserController@update');
    Route::delete('users/{user}', 'UserController@delete');
});
