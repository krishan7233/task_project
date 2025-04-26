<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;





Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/place-order/{id}', [HomeController::class, 'placeOrder'])->middleware('auth');
    Route::get('/my-orders', [HomeController::class, 'users_order'])->name('user.orders');
});
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/category-list', [AdminController::class, 'category_list'])->name('category-list');
    Route::get('/add-category', [AdminController::class, 'add_category'])->name('add-category');
    Route::post('/store-category', [AdminController::class, 'store_category'])->name('store-category');
    Route::get('/category-data', [AdminController::class, 'getCategories'])->name('category.data');
    Route::delete('/delete-category/{id}', [AdminController::class, 'delete_category'])->name('delete-category');
    Route::get('/edit-category/{id}', [AdminController::class, 'edit_category'])->name('edit-category');
    Route::post('/update-category/{id}', [AdminController::class, 'update_category'])->name('update-category');

    Route::get('/product-list', [AdminController::class, 'product_list'])->name('product-list');
    Route::get('/products-data', [AdminController::class, 'fetch_products'])->name('products.data');
    Route::get('/add-product', [AdminController::class, 'add_product'])->name('add-product');
    Route::post('/product', [AdminController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{id}', [AdminController::class, 'edit_product'])->name('edit-product');

    Route::match(['put', 'post'], '/update-product/{id}', [AdminController::class, 'update_product'])->name('update-product');
    Route::delete('/delete-product/{id}', [AdminController::class, 'delete_product'])->name('delete-product');
    Route::delete('product-image/{image}', [AdminController::class, 'deleteImage'])->name('product-image.delete');

    Route::get('/users-list', [AdminController::class, 'userslist'])->name('users-list');
    Route::get('/users-list-data', [AdminController::class, 'users_list'])->name('userslist.data');
    Route::delete('/delete-users/{id}', [AdminController::class, 'delete_users'])->name('delete-users');

    Route::get('/orders-list', [AdminController::class, 'orderslist'])->name('orders-list');

    Route::get('/admin/orders/data', [AdminController::class, 'getOrdersData'])->name('orders.data');
    Route::post('/admin/orders/{orderId}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});