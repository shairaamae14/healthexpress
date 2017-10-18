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
Route::post('/home/dish', 'HomeController@showDish')->name('show.dish');
Route::get('/displayDishes', 'HomeController@searchDishes')->name('search.dish');
// Route::get('addToCart/{id}', 'HomeController@addToCart')->name('dish.addtocart');

Route::post('/cart', 'CartController@cart');
Route::get('/cart/update', 'CartController@updateCart');
Route::post('/cart/clear', 'CartController@destroyCart');
Route::get('/cart/dish/remove', 'CartController@removeDish');

Route::post('/pcart', 'PcartController@cart');

Route::post('/cart/checkout', 'OrdersController@checkout');
Route::post('/cart/order', 'OrdersController@store')->name('order.place');
Route::post('/cart/pay', 'OrdersController@payment')->name('order.payment');
Route::post('/initCustomer', 'OrdersController@initCustomer');


Route::post('/cart/checkout', 'OrdersController@checkout')->name('checkout');
Route::post('/cart/order', 'OrdersController@store')->name('order.place');
Route::get('/orderstatus', 'OrdersController@show')->name('order.orderhistory');
Route::post('/order/updatestatus/{id}', 'OrdersController@changeToReceived')->name('order.statuschange');
Route::post('/order/updatetodone/{id}', 'OrdersController@changeToDone')->name('order.donestatus');
Route::get('/pastorders', 'OrdersController@pastOrders')->name('order.pastorders');
// Route::get('cart/order/status', 'OrdersController@show')->name('order.history');



Route::get('/home', 'HomeController@index');
Route::post('/home/express', 'HomeController@express');
Route::get('/home/express', 'HomeController@express');
Route::get('/displayDishes', 'HomeController@searchDishes')->name('search.dish');


Route::get('/user/{id}', 'UserProfController@show')->name('user.profile');
Route::post('user/{id}', 'UserProfController@update')->name('user.profile.update');
Route::post('user/AddAller/{id}', 'UserProfController@store')->name('user.profile.add');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


//Planned Meals
Route::get('/plan/{plan}', 'PlannedMController@show');
Route::get('/braintree/token', 'PlannedMController@token');
Route::post('/subscribe', 'PlannedMController@subscribe');
Route::get('/plannedmeals', 'PlannedMController@index')->name('user.plan.index');
Route::post('/plan/create', 'PlannedMController@store')->name('user.plan.store');
Route::get('/plannedmeal/schedule', 'PlannedMController@show')->name('user.plan.show');


Route::group(['middleware' => 'subscribed'], function () {
    //Subscriptions
    Route::get('/subscription', 'SubscriptionsController@index')->name('subscriptions');
    Route::post('/subscription/resume', 'SubscriptionsController@resume');
    Route::post('/subscription/cancel', 'SubscriptionsController@cancel');
    Route::get('/meals/{plan}', 'PlannedMController@chooseMeal')->name('choose.meal');
});


Route::post('braintree/webhooks','\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

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
	Route::get('dishes/update/{id}', 'DishController@update')->name('cook.dishes.update');
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


//Admin
Route::prefix('admin')->group(function() {
	Route::get('/', 'AdminController@index');
	Route::post('/addAllergen', 'AdminController@storeAllergens')->name('add.allergen');
	Route::post('/addMedcon', 'AdminController@storeMedCon')->name('add.medcon');
	Route::post('/addPreparation', 'AdminController@storePreparation')->name('add.prep');
	Route::post('/addMeasurement', 'AdminController@storeMeasurement')->name('add.measure');
	Route::post('/addBestEaten', 'AdminController@storeBestEaten')->name('add.best');

	Route::post('/updateAllergen/{id}', 'AdminController@updateAllergens')->name('update.allergen');
	Route::post('/updateMedCon/{id}', 'AdminController@updateMedCon')->name('update.medcon');
	Route::post('/updatePreparation/{id}', 'AdminController@updatePreparation')->name('update.prep');
	Route::post('/updateMeasurement/{id}', 'AdminController@updateMeasurement')->name('update.measure');
	Route::post('/updateBestEaten/{id}', 'AdminController@updateBestEaten')->name('update.best');
	
	Route::post('/deleteAllergen' , 'CoachingFormController@deleteAllergen');
	Route::post('/deleteMedCon' , 'CoachingFormController@deleteMedCon');
	Route::post('/deletePreparation' , 'CoachingFormController@deletePreparation');
	Route::post('/deleteMeasurement' , 'CoachingFormController@deleteMeasurement');
	Route::post('/deleteBestEaten' , 'CoachingFormController@deleteBestEaten');
});
