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

Route::get('/', 'HomeController@index')->name('frontend.home');
Route::get('/product/{slug?}', 'ProductController@showDetails')->name('product.details');
Route::get('/cart', 'CartController@showCart')->name('cart.show');
Route::post('/cart-add', 'CartController@addToCart')->name('cart.add');
Route::post('/cart-remove', 'CartController@removeFromCart')->name('cart.remove');
Route::get('/checkout', 'CartController@checkout')->name('checkout');

Route::get('login','AuthController@loginForm')->name('login');
Route::post('login/process','AuthController@loginProcess')->name('login.Process');

Route::get('register','AuthController@registerForm')->name('register');
Route::post('register/process','AuthController@registerProcess')->name('register.Process');

Route::get('activate','AuthController@activate')->name('activate');
Route::get('user-logout','AuthController@logout')->name('user.logout');

Route::post('/oder', 'CartController@order')->name('order');


