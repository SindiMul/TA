<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::livewire('/', 'home')->name('home');
Route::livewire('/products', 'product-index')->name('products');
Route::livewire('/products/Category/{categoryId}', 'product-liga')->name('products.category');
Route::livewire('/products/{slug}', 'product-detail')->name('products.detail');
Route::livewire('/keranjang', 'keranjang')->name('keranjang');
Route::livewire('/transaction', 'transaction')->name('transaction');
Route::livewire('/history', 'history')->name('history');
Route::get('/oke', 'OkeController@success')
->name('oke')
->middleware(['auth','verified']);
Route::get('/detail/{slug}', 'DetailController@index')
    ->name('detail');

    Route::post('/checkout/{id}', 'CheckoutController@process')
    ->name('checkout_process')
    ->middleware(['auth','verified']);


    Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth','verified']);

    Route::post('/checkout/create/{detail_id}', 'CheckoutController@create')
    ->name('checkout-create')
    ->middleware(['auth','verified']);

    Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove')
    ->name('checkout-remove')
    ->middleware(['auth','verified']);

    Route::get('/checkout/confirm/{id}', 'CheckoutController@success')
    ->name('checkout-success')
    ->middleware(['auth','verified']);

    Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('event-package', 'EventPackageController');
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::resource('productgalery', 'ProductgaleriController');
        Route::resource('gallery', 'GalleryController');
        Route::resource('galery', 'GaleryController');
        Route::resource('transaction', 'TransactionController');
        Route::resource('transaction2', 'Transaction2Controller');
       
    });

Auth::routes(['verify' => true]);
