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

    //cart
    Route::post('/add-to-cart', 'CartController@add_to_cart')->name('cart.add.quick.view');
    Route::get('/all-cart', 'CartController@all_cart')->name('cart.all');
    Route::get('/my-cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/destroy', 'CartController@destroy')->name('cart.destroy');
    Route::delete('/cart/product/remove/{rowId}', 'CartController@remove')->name('cart.product.remove');
    Route::post('/cart/product/update/{rowId}', 'CartController@update')->name('cart.product.update');

    //review
    Route::post('/review/store', 'ReviewController@store')->name('review.store');

    //wishlist
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
    Route::get('/wishlist/store/{id}', 'WishlistController@store')->name('wishlist.store');
    Route::get('/wishlist/delete', 'WishlistController@destroy')->name('wishlist.destroy');
    Route::get('/wishlist/delete/{id}', 'WishlistController@destroy_by_id')->name('wishlist.destroy.id');

    //categorywise product
    Route::get('/category/product/{id}', 'IndexController@categoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategory/product/{id}', 'IndexController@subcategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}', 'IndexController@childcategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brand/product/{id}', 'IndexController@brandWiseProduct')->name('brandwise.product');
});
