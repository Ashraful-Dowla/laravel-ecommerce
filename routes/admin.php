<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/home', "AdminController@admin")->name('admin.home');
    Route::get('/admin/password/change', "AdminController@passwordChange")->name('admin.password.change');
    Route::post('/admin/password/update', "AdminController@passwordUpdate")->name('admin.password.update');
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

    //brand
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::get('/list', 'BrandController@list')->name('brand.list');
        Route::post('/store', 'BrandController@store')->name('brand.store');
        Route::get('/delete/{id}', 'BrandController@destroy')->name('brand.delete');
        Route::get('/edit/{id}', 'BrandController@edit')->name('brand.edit');
        Route::post('/update/{id}', 'BrandController@update')->name('brand.update');
    });

    //setting
    Route::group(['prefix' => 'setting'], function () {

        //seo
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', 'SettingController@seo')->name('seo.setting');
            Route::post('/update/{id}', 'SettingController@seoUpdate')->name('seo.setting.update');
        });

        //smtp
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', 'SettingController@smtp')->name('smtp.setting');
            Route::post('/update/{id}', 'SettingController@smtpUpdate')->name('smtp.setting.update');
        });

        //website
        Route::group(['prefix' => 'website'], function () {
            Route::get('/', 'SettingController@website')->name('website.setting');
            Route::post('/update/{id}', 'SettingController@websiteUpdate')->name('website.setting.update');
        });

        //page
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', 'PageController@index')->name('page.index');
            Route::get('/create', 'PageController@create')->name('page.create');
            Route::post('/store', 'PageController@store')->name('page.store');
            Route::get('/delete/{id}', 'PageController@destroy')->name('page.delete');
            Route::get('/edit/{id}', 'PageController@edit')->name('page.edit');
            Route::post('/update/{id}', 'PageController@update')->name('page.update');
        });
    });
});
