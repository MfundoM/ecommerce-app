<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// WEBSITE ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// USER ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

// ADMIN ROUTES
Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // BRANDS ROUTES
    Route::resource('/admin/brands', BrandController::class)->except(['show']);

    // CATEGORIES ROUTES
    Route::resource('/admin/categories', CategoryController::class)->except(['show']);

    // PRODUCTS ROUTES
    Route::resource('/admin/products', ProductController::class);
});
