<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserLoginController;

use App\Http\Controllers\SystemControlsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', [UserLoginController::class, "login"]);


Route::get('/main', [SystemControlsController::class, "appMain"]);
Route::get('/list', [SystemControlsController::class, "recordList"]);
Route::get('/view', [SystemControlsController::class, "recordView"]);
Route::get('/submit', [SystemControlsController::class, "recordSubmit"]);

