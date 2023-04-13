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

use App\Http\Controllers\productController;

// Route::get('/', 'HomeController@index')->name('root');

//商品一覧　画面表示
Route::get('/', 'productController@showList')->name('products');

Route::get('/product/search', 'productController@search')->name('search');

//商品登録　画面表示
Route::get('/product/create', 'productController@showCreate')->name('create');

//商品登録　機能
Route::post('/product/store', 'productController@exeStore')->name('store');

//商品詳細　画面表示
Route::get('/product/detail/{id}', 'productController@showDetail')->name('detail');

//商品情報編集　画面表示
Route::get('/product/edit/{id}', 'productController@showEdit')->name('edit');

//商品情報編集　機能
Route::post('/product/update','productController@exeUpdate')->name('update');

//商品削除　機能
Route::post('/product/delete/{id}', 'productController@exeDelete')->name('delete');


//ログイン　機能
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
