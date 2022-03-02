<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//employee
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/employee',[App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee/update/{id}',[App\Http\Controllers\EmployeeController::class, 'update_employee']);
});

//product&categories
Route::get('/product',[App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/addcategories',[App\Http\Controllers\CategoriesController::class,'store']);
Route::post('/categories/update/{id}',[App\Http\Controllers\CategoriesController::class,'update_cate']);
Route::post('/categories/delete/{id}',[CategoriesController::class,'delete_cate']);
Route::post('/addproduct',[App\Http\Controllers\ProductController::class,'store']);
Route::post('/product/update/{id}',[App\Http\Controllers\ProductController::class,'update_pd']);
Route::post('/Product/delete/{id}',[App\Http\Controllers\ProductController::class,'delete_pd']);

//warehouse
Route::get('/stock',[App\Http\Controllers\StockController::class, 'index'])->name('stock');
Route::post('/stock/fetch',[App\Http\Controllers\StockController::class, 'fetch'])->name('droupdown.fetch');
Route::post('/stock/update',[App\Http\Controllers\StockController::class, 'updatestock']);

//user
Route::get('/user',[App\Http\Controllers\HomeController::class,'profile'])->name('profile');
Route::post('/user/update',[App\Http\Controllers\HomeController::class,'update_user'])->name('update_user');
Route::post('/user/chang-password',[App\Http\Controllers\HomeController::class,'changPassword'])->name('changPassword');

//cart
Route::get('/cart',[App\Http\Controllers\ProductController::class, 'cart'])->name('cart');
Route::post('product/saveCart',[App\Http\Controllers\OrderController::class, 'saveCart'])->name('saveCart');
Route::get('/order',[App\Http\Controllers\OrderController::class, 'index'])->name('order');
Route::post('/order/edit/{id}',[App\Http\Controllers\OrderController::class, 'editstatus']);
Route::get('/order_detail{order_id}',[App\Http\Controllers\OrderController::class, 'order_detail'])->name('orderdetail');
Route::get('/pdf/show/{id}',[App\Http\Controllers\OrderController::class,'pdfer']);

//dashboard
Route::get('/dashboard/sale',[App\Http\Controllers\DashboardController::class,'ReportSale'])->name('ReportSale');
Route::get('/dashboard/warehouse',[App\Http\Controllers\DashboardController::class,'ReportWarehouse'])->name('ReportWarehouse');
