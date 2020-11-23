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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->name('test');
Route::resource('brands', 'BrandsController');
Route::resource('addresses', 'AddressesController');
Route::resource('categories', 'CategoriesController');
Route::resource('subCategories', 'SubCategoriesController');
Route::resource('promotions', 'PromotionsController');
Route::resource('products', 'ProductsController');
Route::resource('shippingMethods','ShippingMethodsController');
Route::get('productImages/create/{product_id}', 'ProductImagesController@create');
Route::get('productImages/all/{product_id}', 'ProductImagesController@all');
Route::resource('productImages', 'ProductImagesController');
Route::post('carts/{product_id}','CartController@store');
Route::get('carts','CartController@index')->name('carts');
Route::delete('carts/{cart}','CartController@destroy');
Route::delete('carts/Product/{cartProduct}','CartController@destroyProduct');
Route::patch('carts/{cartProduct}','CartController@update');
Route::get('carts/check','CartController@check');
Route::get('checkOut','CheckOutController@index');
Route::resource('orders', 'OrdersController');


Route::group(['middleware' => 'auth'], function () {	
	Route::post('profiles', 'ProfilesController@store')->name('profiles.store');	
	Route::get('profiles/create', 'ProfilesController@create')->name('profiles.create');
	Route::get('profiles/{profile}', 'ProfilesController@show')->name('profiles.show');
	Route::patch('profiles/{profile}', 'ProfilesController@update')->name('profiles.update');
	Route::delete('profiles/{profile}', 'ProfilesController@destroy')->name('profiles.destroy');
	Route::get('profiles/{profile}/edit', 'ProfilesController@edit')->name('profiles.edit');
	Route::get('my/profile', 'ProfilesController@getMyProfile')->name('myProfile');
	Route::get('payment/paypal/{order}','PaymentController@payWithPayPal');
	Route::get('payment/creditCard/{order}','PaymentController@payCreditCard');
	Route::post('payment/creditCard/{order}', 'PaymentController@stripePost');
	Route::get('payment/cash/{order}','PaymentController@payCash');
	Route::get('payment/success','PaymentController@paymentWithPaypalSuccess');
	Route::get('payment/faild','PaymentController@paymentFaild');
	Route::get('payment/','PaymentController@index');
	Route::get('payment/paymentMethod/{paymentMethod}','PaymentController@paymentMethod');
	Route::get('payment/pay/{order}','PaymentController@pay');
	Route::get('wishLists','WishListsController@index')->name('wishLists');
});


Route::group(['middleware' => 'admin'], function () {	
    Route::get('profiles', 'ProfilesController@index')->name('profiles.index');
});