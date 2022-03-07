<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:Passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    // Route::post('signup', 'App\Http\Controllers\AuthController@signUp');
    Route::post('/signup', [App\Http\Controllers\AuthController::class, 'signUp']);
    Route::post('/login', [App\Http\Controllers\AuthController::class,'login']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('user', 'App\Http\Controllers\AuthController@user');
    });
});

//'App\Http\Controllers\AuthController@login'
// 'App\Http\Controllers\AuthController@signUp'
// 'App\Http\Controllers\AuthController@logout'
// 'App\Http\Controllers\AuthController@user'
