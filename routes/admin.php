<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SpecialController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('categories', CategoryController::class)->middleware('admin');
Route::get('/categories/{id}/status', [CategoryController::class, 'status'])->middleware('admin');



Route::resource('units', UnitController::class)->middleware('admin');
Route::get('/units/{id}/status', [UnitController::class, 'status'])->middleware('admin');
Route::get('/units/by_order_type/{id}',[UnitController::class, 'by_order_type']);

Route::resource('items', ItemController::class)->middleware('admin')->middleware('admin');
Route::get('/items/{id}/status', [ItemController::class, 'status'])->middleware('admin');
Route::get('/items/by_order_type/{id}',[ItemController::class, 'by_order_type']);
Route::get('/search', [ItemController::class, 'Search']);
Route::get('/items/item_price/{id}',[ItemController::class, 'item_price']);

Route::get('users/admin', [UserController::class, 'admin'])->name('users.admin')->middleware('admin');
Route::get('users/branch', [UserController::class, 'branch'])->name('users.branch')->middleware('admin');
Route::get('users/supplier', [UserController::class, 'supplier'])->name('users.supplier')->middleware('admin');
Route::resource('users', UserController::class)->middleware('admin');
Route::get('/users/{id}/status', [UserController::class, 'status'])->middleware('admin');
Route::get('/users/{id}/permission', [UserController::class, 'permission'])->middleware('admin');
Route::post('/users/{id}/set_permission', [UserController::class, 'set_permission'])->middleware('admin');

Route::get('/orders/my_orders', [OrderController::class,'my_orders'])->name('my_orders');
Route::get('/orders/my_orders/{id}', [OrderController::class, 'show_my_order']);
Route::get('/orders/{id}/read', [OrderController::class,'read']);
Route::get('/orders/statistics', [OrderController::class,'statistics'])->middleware('admin');
Route::resource('orders', OrderController::class);

Route::get('/special_order/my_orders/{id}', [SpecialController::class, 'show_my_order']);
Route::get('/special_order/{id}/read', [SpecialController::class,'read']);
Route::resource('special_order', SpecialController::class);








});



