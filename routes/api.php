<?php

use App\Http\Controllers\Api\AslabController;
use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecruitationController;
use App\Http\Controllers\Api\ProjectShowcaseController;
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
Route::post('project-showcases/{project_showcase}', [ProjectShowcaseController::class, 'update']);
Route::delete('project-showcases/{project_showcase}', [ProjectShowcaseController::class, 'destroy']);
Route::get('/yazidal/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::delete('/yazidal/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::post('/yazidal/aslab', [AslabController::class, 'store'])->name('blogs.store');
Route::get('/yazidal/aslab', [AslabController::class, 'index'])->name('aslab.index');
// Route::prefix('api')->group(function () {
//     Route::get('/blogs', [BlogController::class, 'index']);
// });

Route::post('/blog', [BlogController::class, 'store']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/Aslab/{id}', [AslabController::class, 'show']);
Route::get('/Aslab', [AslabController::class, 'index']);
Route::post('/Aslab', [AslabController::class, 'store']);
Route::post('/blog/{id}', [BlogController::class, 'update']);
