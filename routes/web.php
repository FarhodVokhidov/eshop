<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::get('dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('admin.home');
    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function (){
        Route::get('/category','index')->name('admin.category');
        Route::get('/category/create','create')->name('admin.category.create');
        Route::post('/category','store')->name('admin.category.store');
        Route::get('/category/{category}/edit','edit');
        Route::put('/category/{category}','update');
    });
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function (){
        Route::get('/product','index')->name('admin.product');
        Route::get('/product/create','create')->name('admin.product.create');
        Route::post('/product','store')->name('admin.product.store');
        Route::get('/product/{product}/edit','edit')->name('admin.product.edit');
        Route::put('/product/{product}','update')->name('admin.product.update');
        Route::get('/product-image/{product_image_id}/delete','destroyImage')->name('admin.product.image.destroy');
        Route::get('/product/{product_id}/delete','destroy')->name('admin.product.destroy');
    });
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function (){




    });
        Route::get('/brands',App\Http\Livewire\Admin\Brand\Index::class)->name('admin.brands');
});
