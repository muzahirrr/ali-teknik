<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Admin\ServiceGalleryController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{service:slug}', [DetailController::class, 'index'])->name('detail');

Route::middleware('auth')->group(function () {
    Route::get('/order/{service:slug}', [OrderController::class, 'index'])->name('order');
    Route::post( '/order/{service:slug}', [OrderController::class, 'store'])->name('order');
});


Route::group(['prefix' => 'user/dashboard', 'middleware' => ['auth', 'user']], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/transactions', [DashboardTransactionController::class, 'index'])->name('user.dashboard-transaction');
    Route::get('/settings', [DashboardSettingController::class, 'index'])->name('user.dashboard-setting');
    Route::put('/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('user.dashboard-update');
});

Route::group(['prefix' => 'admin/dashboard', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::put('/transactions/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-update');
    Route::get('/settings', [DashboardSettingController::class, 'index'])->name('dashboard-setting');
    Route::resource('service', ServiceController::class);
    Route::resource('service_gallery', ServiceGalleryController::class);
    Route::resource('user', UserController::class);
});

Auth::routes();
