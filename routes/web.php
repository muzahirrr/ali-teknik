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
use App\Http\Controllers\Admin\TransactionController;
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
Route::get('/order/{service:slug}', [OrderController::class, 'index'])->name('order');

Route::middleware(['auth'])->group(function () {
  Route::post('/order/{service}', [OrderController::class, 'store'])->name('order-store');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
  Route::get('/dashboard/transactions/{transaction}', [DashboardTransactionController::class, 'edit'])->name('dashboard-transaction-detail');
  Route::put('/dashboard/transactions/{transaction}', [DashboardTransactionController::class, 'update'])
    ->name('dashboard-transaction-update');
  Route::get('/dashboard/settings', [DashboardSettingController::class, 'index'])->name('dashboard-setting');
  Route::put('/dashboard/settings/{user}', [DashboardSettingController::class, 'update'])->name('dashboard-setting-update');
});

Route::prefix('admin')
  ->middleware(['auth', 'admin'])
  ->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('service', ServiceController::class);
    Route::resource('service_gallery', ServiceGalleryController::class);
    Route::resource('user', UserController::class);
    Route::resource('transaction', TransactionController::class);
    route::get('/cetak/{tglawal}/{tglakhir}', [TransactionController::class, 'cetak'])->name('cetak');
  });

Auth::routes();
