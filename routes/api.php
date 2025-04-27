<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiMasters;


Route::middleware('throttle:60,1')->group(function () {


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);    
    Route::post('/users/{id}', [ApiMasters::class, 'update_users']);


    Route::get('/categories', [ApiMasters::class, 'categories_list']);

    Route::get('/products', [ApiMasters::class, 'product_list']);
    Route::get('/products/{id}', [ApiMasters::class, 'product_detail']);



     // Place Order
     Route::post('place-order', [ApiMasters::class, 'placeOrder']);

     // Order List
     Route::get('order-list', [ApiMasters::class, 'orderList']);
     
     // Order Details
     Route::get('order-details/{id}', [ApiMasters::class, 'orderDetails']);
     
     // Update Order Status (Admin only)
     Route::post('update-order-status/{id}', [ApiMasters::class, 'updateOrderStatus']);

     


    Route::middleware('is_admin')->group(function () {
        Route::post('/products', [ApiMasters::class, 'product_add']);
        Route::post('/products/{id}', [ApiMasters::class, 'product_update']);
        Route::delete('/products/{id}', [ApiMasters::class, 'product_delete']);


        Route::post('/add-categories', [ApiMasters::class, 'add_categories']);
        Route::post('/category-update/{id}', [ApiMasters::class, 'category_update']);
        Route::delete('/category-delete/{id}', [ApiMasters::class, 'category_delete']);

        Route::get('/users', [ApiMasters::class, 'userslist']);
        Route::delete('/users/{id}', [ApiMasters::class, 'delete_users']);

    });


});

});


   