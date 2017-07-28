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
Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});



Route::get('/add', 'IndexController@add');

Route::get('/kitchen', 'IndexController@showOrders');

Route::get('/orders', 'IndexController@showWaitersOrders');

Route::get('/users', 'IndexController@showUsers');

Route::post('/kitchen/setTimer', 'IndexController@setTimer');

Route::post('/addOrder', 'IndexController@addOrder');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/saveTime', 'IndexController@saveTime');

Route::post('/saveStatus', 'IndexController@saveStatus');