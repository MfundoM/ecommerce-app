<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// SHOP ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// ACCOUNT ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('account.index');
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
