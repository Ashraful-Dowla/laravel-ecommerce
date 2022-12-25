<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/home', "AdminController@admin")->name('admin.home');
    Route::get('/admin/logout', "AdminController@logout")->name('admin.logout');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
    });

    //subcategory
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubcategoryController@store')->name('subcategory.store');
        Route::get('/delete/{id}', 'SubcategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}', 'SubcategoryController@edit')->name('subcategory.edit');
        Route::post('/update', 'SubcategoryController@update')->name('subcategory.update');
    });

    //child category
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', 'ChildcategoryController@index')->name('childcategory.index');
        Route::get('/list', 'ChildcategoryController@list')->name('childcategory.list');
        Route::post('/store', 'ChildcategoryController@store')->name('childcategory.store');
        Route::get('/subcategory/{id}', 'ChildcategoryController@getSubcategoryByCategoryId')
            ->name('childcategory.getSubcategoryByCategoryId');
        Route::get('/delete/{id}', 'ChildcategoryController@destroy')->name('childcategory.delete');
        Route::get('/edit/{id}', 'ChildcategoryController@edit')->name('childcategory.edit');
        Route::post('/update', 'ChildcategoryController@update')->name('childcategory.update');
    });

});
