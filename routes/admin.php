<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])
            ->name('admin.home')->middleware('is_admin');
