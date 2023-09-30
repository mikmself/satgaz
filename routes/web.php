<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\BouquetCustomController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ToppingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use \Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);

Route::middleware('verified')->group(function () {
    Route::get('/bouquet-custom', [HomeController::class, 'indexBouquetCustom'])->name('index-bouquet-custom');
    Route::post('/create-order', [HomeController::class, 'createOrder'])->name('create-order');
    Route::get('/create-bouquet-custom', [HomeController::class, 'createBouquetCustom'])->name('create-bouquet-custom');
    Route::post('/order-bouquet-custom', [HomeController::class, 'createOrderBouquetCustom'])->name('order-bouquet-custom');
    Route::get('/notifikasi', [HomeController::class, 'indexNotifikasi'])->name('index-notifikasi');
    Route::get('/order', [HomeController::class, 'indexOrder'])->name('index-order');
    Route::post('/pay-dp', [HomeController::class, 'payDP'])->name('pay-dp');
    Route::post('/pay-repayment', [HomeController::class, 'payRepayment'])->name('pay-repayment');
    Route::post('/store-dp', [HomeController::class, 'storeDP'])->name('store-dp');
    Route::post('/store-repayment', [HomeController::class, 'storeRepayment'])->name('store-repayment');
    Route::get('/finish/{id}', [HomeController::class, 'finish'])->name('finish-order');

    Route::prefix('keranjang')->group(function (){
        Route::get('/',[CartController::class,'index'])->name('index-cart');
        Route::get('/tambah/{bouquet_id}',[CartController::class,'addToCart'])->name('create-cart');
        Route::delete('/delete/{id}',[CartController::class,'destroy'])->name('destroy-cart');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/admin/dashboard')->group(function () {
    Route::prefix('bouquet-customs')->group(function () {
        Route::post('/store', [BouquetCustomController::class, 'store'])->name('store-bouquet-custom');
        Route::delete('/delete/{id}', [BouquetCustomController::class, 'destroy'])->name('destroy-bouquet-custom');
    });
    Route::post('/orders/store', [OrderController::class, 'store'])->name('store-order');

    Route::middleware('ceklevel')->group(function (){
        Route::get('/bouquet-customs', [BouquetCustomController::class, 'index'])->name('index-admin-bouquet-custom');
        Route::prefix('bouquets')->group(function () {
            Route::get('/', [BouquetController::class, 'index'])->name('index-bouquet');
            Route::get('/create', [BouquetController::class, 'create'])->name('create-bouquet');
            Route::post('/store', [BouquetController::class, 'store'])->name('store-bouquet');
            Route::get('/edit/{id}', [BouquetController::class, 'edit'])->name('edit-bouquet');
            Route::patch('/update/{id}', [BouquetController::class, 'update'])->name('update-bouquet');
            Route::delete('/delete/{id}', [BouquetController::class, 'destroy'])->name('destroy-bouquet');
        });
        Route::prefix('notifications')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index-notification');
            Route::get('/create', [NotificationController::class, 'create'])->name('create-notification');
            Route::post('/store', [NotificationController::class, 'store'])->name('store-notification');
            Route::get('/edit/{id}', [NotificationController::class, 'edit'])->name('edit-notification');
            Route::patch('/update/{id}', [NotificationController::class, 'update'])->name('update-notification');
            Route::delete('/delete/{id}', [NotificationController::class, 'destroy'])->name('destroy-notification');
        });
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index-order-admin');
            Route::get('/acc-dp/{id}', [OrderController::class, 'accDP'])->name('accDP');
            Route::get('/cancel-dp/{id}', [OrderController::class, 'cancelDP'])->name('cancelDP');
            Route::get('/acc-repayment/{id}', [OrderController::class, 'accRepayment'])->name('accRepayment');
            Route::get('/cancel-repayment/{id}', [OrderController::class, 'cancelRepayment'])->name('cancelRepayment');
            Route::get('/half-finish/{id}', [OrderController::class, 'halfFinish'])->name('halfFinish');
            Route::get('/finish/{id}', [OrderController::class, 'finish'])->name('finish');
        });

        Route::prefix('toppings')->group(function () {
            Route::get('/', [ToppingController::class, 'index'])->name('index-topping');
            Route::get('/create', [ToppingController::class, 'create'])->name('create-topping');
            Route::post('/store', [ToppingController::class, 'store'])->name('store-topping');
            Route::get('/edit/{id}', [ToppingController::class, 'edit'])->name('edit-topping');
            Route::patch('/update/{id}', [ToppingController::class, 'update'])->name('update-topping');
            Route::delete('/delete/{id}', [ToppingController::class, 'destroy'])->name('destroy-topping');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index-user');
            Route::get('/create', [UserController::class, 'create'])->name('create-user');
            Route::post('/store', [UserController::class, 'store'])->name('store-user');
            Route::put('/edit/{id}', [UserController::class, 'edit'])->name('edit-user');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update-user');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
        });
    });
});
