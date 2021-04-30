<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'getUser']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
    Route::get('all-users', [UserController::class, 'index']);
    Route::resource('games', GameController::class);
    Route::get('results', [ResultController::class, 'index']);
    Route::post('add-result', [ResultController::class, 'store']);
});
