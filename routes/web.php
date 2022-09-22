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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
Route::get('/',[\App\Http\Controllers\Frontend\FortendController::class,'index']);
Route::get('/collection',[App\Http\Controllers\Frontend\FortendController::class,'categories'])->name('categories');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/collection/{category_slug}',[App\Http\Controllers\Frontend\FortendController::class,'product_by_category'])->name('productcat');
Route::get('/collection/{category_slug}/{product_slug}',[App\Http\Controllers\Frontend\FortendController::class,'productView'])->name('productview');

Route::middleware(['auth'])->group(function (){
    Route::get('/wishlist',[\App\Http\Controllers\Frontend\WishlistController::class,'index']);
    Route::get('cart',[\App\Http\Controllers\Frontend\CartController::class,'index']);
});
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
        Route::post('/product-color/{product_color_id}','updateProductColorQty');
        Route::get('/product-color/{product_color_id}/delete','deleteProductColor');
    });
    Route::controller(\App\Http\Controllers\Admin\ColorController::class)->group(function (){
        Route::get('/colors','index')->name('admin.color');
        Route::get('/colors/create','create')->name('admin.color.create');
        Route::post('/colors','store')->name('admin.colors.store');
        Route::get('/colors/{color}/edit','edit')->name('admin.color.edit');
        Route::put('/colors/{color}','update')->name('admin.color.update');
        Route::get('/colors/{color}/delete','destroy')->name('admin.delete.destroy');
    });
    Route::controller(\App\Http\Controllers\Admin\SlideController::class)->group(function (){
        Route::get('/sliders','index')->name('admin.sliders');
        Route::get('/sliders/create','create')->name('admin.sliders.create');
        Route::post('/sliders/create','store')->name('admin.sliders.store');
        Route::get('/sliders/{sliders}/edit','edit')->name('admin.sliders.edit');
        Route::put('/sliders/{slider}/update','update')->name('admin.sliders.update');
        Route::get('/sliders/{slider}/delete','destroy')->name('admin.sliders.destroy');
    });

        Route::get('/brands',App\Http\Livewire\Admin\Brand\Index::class)->name('admin.brands');
});
