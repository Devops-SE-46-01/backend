<?php

use App\Http\Controllers\Api\AslabController;
use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RecruitationController;

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
Route::get('/yazidal/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::delete('/yazidal/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::post('/yazidal/aslab', [AslabController::class, 'store'])->name('blogs.store');
Route::get('/yazidal/aslab', [AslabController::class, 'index'])->name('aslab.index');
// Route::prefix('api')->group(function () {
//     Route::get('/blogs', [BlogController::class, 'index']);
// });

