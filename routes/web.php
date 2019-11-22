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
use Illuminate\Support\Facades\Mail;
Auth::routes();









Route::get('/', function () {
	return view('store.store');
});


Route::prefix('admin')->group(function(){
	Route::get('login', 'Admin_Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin_Auth\LoginController@login')->name('admin.login');
	Route::post('logout', 'Admin_Auth\LoginController@logout')->name('admin.logout');

	Route::get('register', 'Admin_Auth\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'Admin_Auth\RegisterController@register')->name('admin.register');

	Route::middleware('admin.auth')->group(function(){
		Route::get('dashboard', function(){
			return view('dashboard');
		});

		//ATTRIBUTE
Route::get('attribute', 'AttributeController@attribute');
Route::get('attribute/list', 'AttributeController@attlist');
Route::post('attribute', 'AttributeController@store');
Route::delete('attribute/{id}', 'AttributeController@destroy');
//SIZECOLOR
Route::get('size','SizeColorController@size');
Route::get('size/list', 'SizeColorController@sizelist');
Route::post('size', 'SizeColorController@sizestore');
Route::delete('size/{id}', 'SizeColorController@sizedestroy');

Route::get('color', 'SizeColorController@color');
Route::get('color/list', 'SizeColorController@colorlist');
Route::post('color', 'SizeColorController@colorstore');
Route::delete('color/{id}', 'SizeColorController@colordestroy');
Route::post('adddetail', 'SizeColorController@adddetail');
//PRODUCT


Route::get('products', 'ProductController@index');
Route::get('products/list', 'ProductController@anyData');
Route::post('products', 'ProductController@store');
Route::get('products/{id}/edit', 'ProductController@edit');
Route::delete('products/{id}', 'ProductController@destroy');
Route::post('products/upload', 'ProductController@upload');
Route::get('products/addlist/{id}','ProductController@editList');
Route::post('products/{id}','ProductController@update');
Route::get('products/{id}', 'ProductController@show');
Route::get('addDetail/{id}/edit','ProductController@editdetail');
Route::post('addDetail/{id}','ProductController@updateDetail');
Route::delete('addDetail/{id}','ProductController@destroyDe');

//CATEGORY

Route::get('category', 'CategoryController@category');
Route::get('category/list', 'CategoryController@catelist');
Route::post('category', 'CategoryController@store');
Route::delete('category/{id}', 'CategoryController@destroy');

Route::get('subcategory', 'SubCategoryController@category');
Route::get('subcategory/list', 'SubCategoryController@catelist');
Route::get('subcategory/{id}', 'SubCategoryController@catesub');
Route::post('subcategory', 'SubCategoryController@store');
Route::delete('subcategory/{id}', 'SubCategoryController@destroy');
//ORDER

Route::get('orders', 'OrderController@index');
Route::get('order/list', 'OrderController@anyway');
Route::post('order/update','OrderController@updateStatus');
Route::get('order/{id}','OrderController@detail');
Route::get('status/{id}', 'OrderController@status');

Route::get('users', 'UserController@index');
Route::get('users/list', 'UserController@anyData');
Route::post('users', 'UserController@store');
Route::post('users/{id}', 'UserController@update');
Route::delete('users/{id}', 'UserController@destroy');


	});
});

Auth::routes();
Route::get('', 'StoreController@index');
Route::get('/detail/{id}', 'StoreController@detail');
Route::post('getsize','StoreController@size');
Route::post('getquantity','StoreController@quantity');
Route::get('cart', 'CartController@index');
Route::post('cart', 'CartController@cart');
Route::get('cart/{id}', 'CartController@destroy');
// Route::get('email',function(){
// 	Mail::to('michellenguyen239@gmail.com')->send(new \App\Mail\Order());
// });
Route::post('email','CartController@email');
Route::post('cart/order', 'CartController@order');
Route::get('orderDetail/{id}','CartController@orderDetail');
Route::get('myaccount','CartController@myaccount');
Route::post('deleteOrder/{id}','OrderController@deleteOrder');
Route::get('store/{slug}','StoreController@shop');
// Route::get('/home', 'HomeController@index')->name('home');
