<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SchoolLevelController;
use App\Http\Controllers\Admin\SchoolStageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyGuest;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/admin', '/admin/dashboard');

Route::middleware([OnlyGuest::class])->group(function () {
    Route::get('admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('admin/login', [AuthController::class, 'authenticate']);
});

Route::middleware([Authenticate::class, OnlyAdmin::class])->prefix('admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('', 'edit');
        Route::post('save', 'save');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::match(['get', 'post'], 'delete/{id}', 'delete');
        Route::match(['get', 'post'], 'profile', 'profile');
    });

    Route::controller(UserActivityController::class)->prefix('user-activity')->group(function () {
        Route::get('', 'index');
        Route::get('show/{id}', 'show');
        Route::post('delete', 'delete');
    });
});
