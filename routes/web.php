<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecruitationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->middleware('guest');
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/test', function () {
    return phpinfo();
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/admins', AdminController::class)->middleware('can:admin');
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/blogs', BlogController::class);
    Route::get('/recruitations/export', [RecruitationController::class, 'export'])->name('recruitations.export');
    Route::resource('/recruitations', RecruitationController::class);
    Route::get('/settings', function () {
    })->name('settings.index');

    // Aslab routes
    Route::resource('aslabs', App\Http\Controllers\AslabController::class);
});
