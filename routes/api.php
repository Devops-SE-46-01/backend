<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\RecruitationController;
use App\Http\Controllers\BlogController as ControllersBlogController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/recruitation/check/{nim}', [RecruitationController::class, 'check']);
Route::post('/recruitation', [RecruitationController::class, 'store']);



Route::get('/blog', [BlogController::class, 'index']);
Route::post('/blog', [BlogController::class, 'create']);
Route::post('/blog/{id}', [BlogController::class, 'update']);
