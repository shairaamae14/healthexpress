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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index')->name('user.index');
Route::get('/home/dish/details/{id}', 'HomeController@showDetails')->name('home.details');
// Route::get('addToCart/{id}', 'HomeController@addToCart')->name('dish.addtocart');

Route::post('/cart', 'CartController@cart');
Route::get('/cart/update', 'CartController@updateCart');
Route::post('/cart/clear', 'CartController@destroyCart');
Route::get('/cart/dish/remove', 'CartController@removeDish');
<<<<<<< HEAD
Route::post('/cart/checkout', 'CartController@checkout');
Route::post('/cart/order', 'OrdersController@store')->name('order.place');
=======
Route::post('/cart/checkout', 'OrdersController@checkout')->name('checkout');
Route::post('/cart/order', 'OrdersController@store')->name('order.place');
Route::get('/cart/orderhistory', 'OrdersController@show')->name('order.orderhistory');
Route::post('/cart/order/updatestatus/{id}', 'OrdersController@changeToReceived')->name('order.statuschange');
Route::post('/cart/order/updatetodone/{id}', 'OrdersController@changeToDone')->name('order.donestatus');
Route::get('/cart/pastorders', 'OrdersController@pastOrders')->name('order.pastorders');
// Route::get('cart/order/status', 'OrdersController@show')->name('order.history');

>>>>>>> 2646ad20dfde083a10a0fdda50c5327568fb2e6c

Route::get('/home', 'HomeController@index');
Route::post('/home/express', 'HomeController@express');
Route::get('/home/express', 'HomeController@express');
Route::get('/displayDishes', 'HomeController@searchDishes')->name('search.dish');


Route::get('/user/{id}', 'UserProfController@show')->name('user.profile');
Route::post('user/{id}', 'UserProfController@update')->name('user.profile.update');
Route::post('user/AddAller/{id}', 'UserProfController@store')->name('user.profile.add');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


//Planned Meals
Route::get('/plannedmeals', 'HomeController@plannedindex');

Route::prefix('cook')->group(function() {
	Route::get('/login', 'Auth\CookLoginController@show')->name('cook.login');
	Route::post('/login', 'Auth\CookLoginController@login')->name('cook.login.submit');
	Route::get('/register', 'Auth\CookRegisterController@index')->name('cook.register');
	Route::post('/register', 'Auth\CookRegisterController@create')->name('cook.register.submit');
	Route::get('/', 'CookController@index')->name('cook.dashboard');
	Route::get('/logout', 'Auth\CookLoginController@logout')->name('cook.logout');

	//Password reset routes
	Route::post('/password/email', 'Auth\CookForgotPasswordController@sendResetLinkEmail')->name('cook.password.email');
	Route::get('/password/reset', 'Auth\CookForgotPasswordController@showLinkRequestForm')->name('cook.password.request');
	Route::get('/password/reset/{token}', 'Auth\CookResetPasswordController@showResetForm')->name('cook.password.reset');
	Route::post('/password/reset', 'Auth\CookResetPasswordController@reset');

	
	//Orders

	Route::get('orders', 'CookController@showOrders')->name('cook.orders');
	Route::get('orders/eodetails', function(){
        return view('cook.vieweorder');
	});
	// Route::get('orders', 'CookController@changeOrderStats')->name('cook.changeorderstats');
	Route::get('orders', 'CookController@showExOrders')->name('cook.expressorders');

	
	//Dishes
        Route::get('/dishes/addCatalog', 'DishController@addCatalog')->name('dish.catalog');
        Route::post('/dishes/createCatalog', 'DishController@createCatalog')->name('dish.catalog.create');
        Route::get('dishes', 'DishController@index')->name('cook.dishes');
	Route::get('dishes/add', 'DishController@create')->name('cook.dishes.add');
	Route::post('dishes/create', 'DishController@store')->name('cook.dishes.create');
	Route::get('dishes/{id}', 'DishController@show')->name('cook.dishes.show');
        Route::post('dishes/{id}', 'DishController@update')->name('cook.dishes.update');
        Route::post('dishes/delete/{id}', 'DishController@destroy')->name('cook.dishes.delete');
	Route::get('dishes/edit/{id}', 'DishController@edit')->name('cook.dishes.edit');
	Route::get('dishes/reviews', 'DishController@viewrating')->name('cook.rating');
        
        Route::get('/displayDishes', 'DishController@searchDishes')->name('display');
        Route::get('/previewDishes/{id}', 'DishController@previewDish')->name('preview');
        Route::get('/searchIngredients', 'DishController@searchIngredient')->name('search.ingredient');
        Route::post('/status', 'CookController@changeAvailabilityStat')->name('status.change');
        Route::post('/orderstat', 'CookController@changeOrderStats')->name('orderstat.change');
	// Route::get('dishes/addingredients', 'DishController@adding')->name('cook.addingredients');
        
});

Route::prefix('user')->group(function() {
	Route::get('/cooks', 'OrdersController@index');
	Route::get('/cooks/{id}', 'OrdersController@showCookDishes')->name('user.show.dishes');
});





// Route::get('/', 'SearchController@index');
Route::get('cook/adddish','SearchController@liveSearch'); 
Route::post('search', 'SearchController@search');
