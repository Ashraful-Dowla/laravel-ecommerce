<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/product-details/{slug}', 'IndexController@product_details')->name('product.details');
    Route::get('/product-quick-view/{id}', 'IndexController@product_quick_view')->name('product.quick.view');

    //review
    Route::post('/review/store', 'ReviewController@store')->name('review.store');

    //wishlist
    Route::get('/wishlist/store/{id}', 'WishlistController@store')->name('wishlist.store');
});
