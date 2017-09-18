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
Route::post('/home', 'HomeController@index');



Route::get('/home', 'HomeController@index');
Route::get('home/express', 'HomeController@express');
Route::get('/home/express/breakfast', 'HomeController@showBfast');
Route::get('/home/express/lunch', 'HomeController@showLunch');
Route::get('/home/express/dinner', 'HomeController@showDinner');



Route::get('/user/{id}', 'UserProfController@show')->name('user.profile');
// Route::post('user/{id}', 'UserProfController@store')->name('user.profile.create');
Route::post('user/{id}', 'UserProfController@update')->name('user.profile.update');

// Route::get('/user/password/reset{id}', 'Auth\ResetPasswordController@editform')->name('user.profile.reset');


Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


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

    Route::get('dishes', 'DishController@index')->name('cook.dishes');
	Route::get('dishes/add', 'DishController@create')->name('cook.dishes.add');
	Route::post('dishes/create', 'DishController@store')->name('cook.dishes.create');
	Route::get('dishes/details/{id}', 'DishController@viewdet')->name('cook.dishes.det');
	// Route::get('dishes/{id}', 'DishController@show')->name('cook.dishes.show');
	Route::get('dishes/edit/{id}', 'DishController@edit')->name('cook.dishes.edit');
	Route::post('dishes/{id}', 'DishController@update')->name('cook.dishes.update');
	Route::post('dishes/delete/{id}', 'DishController@destroy')->name('cook.dishes.destroy');
	Route::get('dishes/reviews', 'DishController@viewrating')->name('cook.rating');
	// Route::get('dishes/addingredients', 'DishController@adding')->name('cook.addingredients');

});

Route::prefix('user')->group(function() {
	Route::get('/cooks', 'OrdersController@index');
	Route::get('/cooks/{id}', 'OrdersController@showCookDishes')->name('user.show.dishes');
});





// Route::get('/', 'SearchController@index');
Route::get('cook/adddish','SearchController@liveSearch'); 
Route::post('search', 'SearchController@search');
