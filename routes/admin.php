<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/home', "AdminController@admin")->name('admin.home');
    Route::get('/admin/logout', "AdminController@logout")->name('admin.logout');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
    });
});
