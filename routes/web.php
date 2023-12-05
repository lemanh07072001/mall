<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashbord
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/dashboard','index')->name('index');
    });

    Route::controller(CategoryController::class)->name('category.')->group(function () {
        Route::get('/category','index')->name('index');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
