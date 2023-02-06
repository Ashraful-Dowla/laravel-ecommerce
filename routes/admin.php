<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {

    Route::group(['prefix' => 'admin', 'role' => 'admin'], function () {
        Route::get('/home', "AdminController@admin")->name('admin.home');
        Route::get('/password/change', "AdminController@passwordChange")->name('admin.password.change');
        Route::post('/password/update', "AdminController@passwordUpdate")->name('admin.password.update');
        Route::get('/logout', "AdminController@logout")->name('admin.logout');
    });

    //category
    Route::group(['prefix' => 'category', 'role' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
    });

    //subcategory
    Route::group(['prefix' => 'subcategory', 'role' => 'category'], function () {
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubcategoryController@store')->name('subcategory.store');
        Route::get('/delete/{id}', 'SubcategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}', 'SubcategoryController@edit')->name('subcategory.edit');
        Route::post('/update', 'SubcategoryController@update')->name('subcategory.update');
    });

    //childcategory
    Route::group(['prefix' => 'childcategory', 'role' => 'category'], function () {
        Route::get('/', 'ChildcategoryController@index')->name('childcategory.index');
        Route::get('/list', 'ChildcategoryController@list')->name('childcategory.list');
        Route::post('/store', 'ChildcategoryController@store')->name('childcategory.store');
        Route::get('/subcategory/{id}', 'ChildcategoryController@getSubcategoryByCategoryId')
            ->name('childcategory.getSubcategoryByCategoryId');
        Route::get('/childcategory/{id}', 'ChildcategoryController@getChildCategoryBySubCategoryId')
            ->name('childcategory.getChildCategoryBySubCategoryId');
        Route::get('/delete/{id}', 'ChildcategoryController@destroy')->name('childcategory.delete');
        Route::get('/edit/{id}', 'ChildcategoryController@edit')->name('childcategory.edit');
        Route::post('/update', 'ChildcategoryController@update')->name('childcategory.update');
    });

    //brand
    Route::group(['prefix' => 'brand', 'role' => 'category'], function () {
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::get('/list', 'BrandController@list')->name('brand.list');
        Route::post('/store', 'BrandController@store')->name('brand.store');
        Route::get('/delete/{id}', 'BrandController@destroy')->name('brand.delete');
        Route::get('/edit/{id}', 'BrandController@edit')->name('brand.edit');
        Route::post('/update/{id}', 'BrandController@update')->name('brand.update');
    });

    //warehouse
    Route::group(['prefix' => 'warehouse', 'role' => 'category'], function () {
        Route::get('/', 'WarehouseController@index')->name('warehouse.index');
        Route::get('/list', 'WarehouseController@list')->name('warehouse.list');
        Route::post('/store', 'WarehouseController@store')->name('warehouse.store');
        Route::get('/delete/{id}', 'WarehouseController@destroy')->name('warehouse.delete');
        Route::get('/edit/{id}', 'WarehouseController@edit')->name('warehouse.edit');
        Route::post('/update/{id}', 'WarehouseController@update')->name('warehouse.update');
    });

    //product
    Route::group(['prefix' => 'product', 'role' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/list', 'ProductController@list')->name('product.list');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::post('/status-change/{id}', 'ProductController@statusChange')->name('product.statusChange');
        Route::delete('/delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('/update/{id}', 'ProductController@update')->name('product.update');
    });

    //coupon
    Route::group(['prefix' => 'coupon', 'role' => 'offer'], function () {
        Route::get('/', 'CouponController@index')->name('coupon.index');
        Route::get('/list', 'CouponController@list')->name('coupon.list');
        Route::post('/store', 'CouponController@store')->name('coupon.store');
        Route::delete('/delete/{id}', 'CouponController@destroy')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@edit')->name('coupon.edit');
        Route::post('/update/{id}', 'CouponController@update')->name('coupon.update');
    });

    //campaign
    Route::group(['prefix' => 'campaign', 'role' => 'offer'], function () {
        Route::get('/', 'CampaignController@index')->name('campaign.index');
        Route::get('/list', 'CampaignController@list')->name('campaign.list');
        Route::post('/store', 'CampaignController@store')->name('campaign.store');
        Route::delete('/delete/{id}', 'CampaignController@destroy')->name('campaign.delete');
        Route::get('/edit/{id}', 'CampaignController@edit')->name('campaign.edit');
        Route::post('/update/{id}', 'CampaignController@update')->name('campaign.update');
    });

    //campaign product route
    Route::group(['prefix' => 'campaign-product', 'role' => 'offer'], function () {
        Route::get('/{campaign_id}', 'CampaignProductController@index')->name('campaign.product');
        Route::get('/store/{product_id}/{campaign_id}', 'CampaignProductController@store')->name('campaign.product.store');
        Route::get('/list/{campaign_id}', 'CampaignProductController@list')->name('campaign.product.list');
        Route::get('/delete/{id}', 'CampaignProductController@destroy')->name('campaign.product.delete');
    });

    //order
    Route::group(['prefix' => 'order', 'role' => 'order'], function () {
        Route::get('/', 'OrderController@index')->name('order.index');
        Route::get('/list', 'OrderController@list')->name('order.list');
        Route::get('/edit/{id}', 'OrderController@edit')->name('order.edit');
        Route::post('/update/{id}', 'OrderController@update')->name('order.update');
        Route::get('/view/{id}', 'OrderController@view')->name('order.view');
        Route::post('/details/update/{id}', 'OrderController@details_update')->name('order.details.update');
        Route::delete('/delete/{id}', 'OrderController@destroy')->name('order.delete');
    });

    //pickupoint
    Route::group(['prefix' => 'pickup-point', 'pickup'], function () {
        Route::get('/', 'PickupController@index')->name('pickup.point.index');
        Route::get('/list', 'PickupController@list')->name('pickup.point.list');
        Route::post('/store', 'PickupController@store')->name('pickup.point.store');
        Route::delete('/delete/{id}', 'PickupController@destroy')->name('pickup.point.delete');
        Route::get('/edit/{id}', 'PickupController@edit')->name('pickup.point.edit');
        Route::post('/update/{id}', 'PickupController@update')->name('pickup.point.update');
    });

    //ticket
    Route::group(['prefix' => 'ticket', 'role' => 'ticket'], function () {
        Route::get('/', 'TicketController@index')->name('ticket.index');
        Route::get('/list', 'TicketController@list')->name('ticket.list');
        Route::get('/view/{id}', 'TicketController@view')->name('ticket.view');
        Route::post('/reply', 'TicketController@reply')->name('ticket.reply');
        Route::get('/close/{id}', 'TicketController@close')->name('ticket.close');
        Route::delete('/delete/{id}', 'TicketController@destroy')->name('ticket.delete');
    });

    //setting
    Route::group(['prefix' => 'setting', 'role' => 'setting'], function () {

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

        //payment
        Route::group(['prefix' => 'payment'], function () {
            Route::get('/', 'SettingController@payment_gateway')->name('payment.gateway');
            Route::post('/update/{id}', 'SettingController@payment_gateway_update')->name('payment.gateway.update');
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

    //blog category
    Route::group(['prefix' => 'blog/category', 'role' => 'blog'], function () {
        Route::get('/', 'BlogController@index')->name('blog.category.index');
        Route::post('/store', 'BlogController@store')->name('blog.category.store');
        Route::get('/delete/{id}', 'BlogController@destroy')->name('blog.category.delete');
        Route::get('/edit/{id}', 'BlogController@edit')->name('blog.category.edit');
        Route::post('/update', 'BlogController@update')->name('blog.category.update');
    });

    //blog
    Route::group(['prefix' => 'blog', 'role' => 'blog'], function () {
        Route::get('/', 'BlogController@blog_index')->name('blog.index');
        Route::get('/list', 'BlogController@list')->name('blog.list');
        Route::post('/store', 'BlogController@blog_store')->name('blog.store');
        Route::get('/delete/{id}', 'BlogController@blog_destroy')->name('blog.delete');
        Route::get('/edit/{id}', 'BlogController@blog_edit')->name('blog.edit');
        Route::post('/update/{id}', 'BlogController@blog_update')->name('blog.update');
    });

    //contact
    Route::group(['prefix' => 'contact', 'role' => 'contact'], function () {
        Route::get('/', 'ContactController@index')->name('contact.index');
        Route::get('/list', 'ContactController@list')->name('contact.list');
        Route::delete('/delete/{id}', 'ContactController@destroy')->name('contact.delete');
        Route::get('/edit/{id}', 'ContactController@edit')->name('contact.edit');
        Route::post('/update/{id}', 'ContactController@update')->name('contact.update');
    });

    //report
    Route::group(['prefix' => 'report/order', 'role' => 'report'], function () {
        Route::get('/', 'OrderController@report_index')->name('report.order.index');
        Route::get('/list', 'OrderController@report_list')->name('report.order.list');
        Route::get('/print', 'OrderController@report_print')->name('report.order.print');
    });

    //role
    Route::group(['prefix' => 'role', 'role' => 'user_role'], function () {
        Route::get('/', 'RoleController@index')->name('role.manage');
        Route::get('/create', 'RoleController@create')->name('role.create');
        Route::post('/store', 'RoleController@store')->name('role.store');
        Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::get('/delete/{id}', 'RoleController@destroy')->name('role.delete');
        Route::post('/update/{id}', 'RoleController@update')->name('role.update');
    });
});
