<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function () {
  return view('about');
});

Route::group(['middleware' => 'auth'], function() {
  //  Route::resource('diet', 'DietController', ['except' => 'update']);
    
    Route::resource('products', 'ProductController'); //, ['except' => 'submit']);
    Route::resource('checkout', 'CheckoutController'); 
    Route::resource('form-product', 'FormProductController');
});

Route::resource('/purchase', 'PurchaseController');   