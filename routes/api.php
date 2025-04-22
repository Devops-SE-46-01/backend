<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RecruitationController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AslabController;

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

Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/Aslab/{id}', [AslabController::class, 'show']);
Route::get('/Aslab', [AslabController::class, 'index']);
Route::post('/Aslab', [AslabController::class, 'store']);