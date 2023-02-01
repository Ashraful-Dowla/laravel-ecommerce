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

    //checkout
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/coupon/apply', 'CheckoutController@coupon_apply')->name('coupon.apply');
    Route::get('/coupon/remove', 'CheckoutController@coupon_remove')->name('coupon.remove');
    Route::post('/order/place', 'CheckoutController@order_place')->name('order.place');

    //review
    Route::post('/review/store', 'ReviewController@store')->name('review.store');
    Route::get('/review/website', 'ReviewController@website')->name('review.website');
    Route::post('/review/website/store', 'ReviewController@website_review_store')->name('review.website.store');

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

    //customer setting
    Route::get('/customer/profile/setting', 'ProfileController@index')->name('customer.profile.setting');
    Route::post('/customer/password/change', 'ProfileController@password_change')->name('customer.password.change');
    Route::get('/my-order', 'ProfileController@my_order')->name('my.order');
    Route::get('/my-order/view/{id}', 'ProfileController@my_order_view')->name('my.order.view');

    //page view
    Route::get('/page/view/{slug}', 'IndexController@page_view')->name('page.view');

    //newsletter
    Route::post('/newsletter/store', 'IndexController@newsletter_store')->name('newsletter.store');

    //support ticket
    Route::get('/ticket/open', 'ProfileController@ticket_open')->name('ticket.open');
    Route::get('/ticket/new', 'ProfileController@ticket_new')->name('ticket.new');
    Route::post('/ticket/store', 'ProfileController@ticket_store')->name('ticket.store');
    Route::get('/ticket/show/{id}', 'ProfileController@ticket_show')->name('ticket.show');
    Route::post('/reply/ticket', 'ProfileController@ticket_reply')->name('reply.ticket');

    //order track
    Route::get('/order/track/', 'IndexController@order_tracking')->name('order.tracking');
    Route::post('/order/track/check', 'IndexController@order_check')->name('order.check');

    //payment gateway
    Route::post('/success', 'CheckoutController@success')->name('success');
    Route::post('/fail', 'CheckoutController@fail')->name('fail');
    Route::get('/cancel/{id}', 'CheckoutController@cancel')->name('cancel');

    //contact us
    Route::get('/contact-us', 'IndexController@contact_us')->name('contact.us');
    Route::get('/contact-us/store', 'IndexController@contact_us_store')->name('contact.us.store');

    //blog
    Route::get('/our-blog', 'IndexController@our_blog')->name('our.blog');
});

//socialite
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');
