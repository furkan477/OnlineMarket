<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CommentController;
use App\Http\Controllers\Site\CouponController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Site\ProductsController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\StoresController;
use App\Http\Controllers\Site\TicketController;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'LoginShow'])->name('login.show');
Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/register', [AuthController::class, 'RegisterShow'])->name('register.show');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/',[SiteController::class, 'Home'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/stores/category_id={category}', [StoresController::class, 'Stores'])->name('stores');                                             //
    Route::get('/{store}/products', [ProductsController::class, 'ProductsList'])->name('products.list');                    
    Route::post('/{store}/products',[ProductsController::class,'ProductsList'])->name('products.category.filter');
    Route::get('/{product}/products-detail',[ProductsController::class,'ProductsDetail'])->name('products.detail');
    Route::get('cart/{user}',[CartController::class,'Cart'])->name('cart');
    Route::post('cart/{user}',[CartController::class,'Cart'])->name('cart.coupon');
    Route::post('cart-create/{product}',[CartController::class,'CartCreate'])->name('cart.create');
    Route::get('coupon',[CouponController::class,'Coupon'])->name('coupon');
    Route::post('payment',[PaymentController::class,'payment'])->name('payment');
    Route::get('/order/{user}',[OrderController::class,'Order'])->name('order');
    Route::post('/comment/{product}',[CommentController::class,'CommentCreate'])->name('comment.create');
    Route::post('/ticket-create/{product}',[TicketController::class,'TicketCreate'])->name('ticket.create');
    Route::get('/ticket-list',[TicketController::class,'TicketList'])->name('ticket.list');
    Route::get('/ticket-detail/{ticket}',[TicketController::class,'TicketDetail'])->name('ticket.detail');
    Route::post('/ticket-message-create/{ticket}',[TicketController::class,'TicketMessageCreate'])->name('ticket.message.create');
});


Route::group(['middleware' => BuyerMiddleware::class], function () {

});


Route::group(['middleware' => SellerMiddleware::class], function () {
    
    Route::get('/{user}/stores-list',  [StoresController::class, 'UserStores'])->name('user.stores');  
    Route::get('/{store}/stores-update',  [StoresController::class, 'StoresEdit'])->name('stores.edit');                      //
    Route::post('/{store}/stores-update', [StoresController::class, 'StoresUpdate'])->name('stores.update'); 
    Route::get('/stores-add',  [StoresController::class, 'StoresShow'])->name('stores.show');                                //
    Route::post('/stores-add', [StoresController::class, 'StoresCreate'])->name('stores.create');                           //
    Route::post('/{store}/product-add', [ProductsController::class, 'ProductsCreate'])->name('products.create');            //

});