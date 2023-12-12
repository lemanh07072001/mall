<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UploadController;
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

    /* Category */
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/',[CategoryController::class,'index'])->name('index');
        Route::get('move/{id}/{type}',[CategoryController::class,'move'])->name('move');
        Route::get('create',[CategoryController::class,'create'])->name('create');
        Route::post('store',[CategoryController::class,'store'])->name('store');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('update');
        Route::delete('destroy/{id}',[CategoryController::class,'destroy'])->name('destroy');
        Route::post('/addAjax',[CategoryController::class,'addAjax'])->name('addAjax');
    });

    /* Slide */
    Route::prefix('slide')->name('slide.')->group(function () {
        Route::get('/',[SlideController::class,'index'])->name('index');
        Route::get('create',[SlideController::class,'create'])->name('create');
        Route::post('store',[SlideController::class,'store'])->name('store');
        Route::get('edit/{id}',[SlideController::class,'edit'])->name('edit');
        Route::post('update/{id}',[SlideController::class,'update'])->name('update');
        Route::delete('destroy/{id}',[SlideController::class,'destroy'])->name('destroy');
    });

    /* Upload */
    Route::prefix('upload')->name('upload.')->group(function () {
        Route::post('/store',[UploadController::class,'store'])->name('store');

    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
