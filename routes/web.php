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

//Home
Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index')->name('user.index');
Route::get('/home/dish/details/{id}', 'HomeController@showDetails')->name('home.details');
Route::post('/home/dish', 'HomeController@showDish')->name('show.dish');
Route::get('/displayDishes', 'HomeController@searchDishes')->name('search.dish');
Route::get('home/cook/profile/{id}', 'HomeController@showCook')->name('cook.details');

//Express Meal Cart 
Route::post('/cart', 'CartController@cart');
Route::get('/cart/update', 'CartController@updateCart');
Route::post('/cart/clear', 'CartController@destroyCart');
Route::get('/cart/dish/remove', 'CartController@removeDish');

//Express Meal Details Cart
Route::post('/detcart', 'CartController@detcart');
Route::get('/detcart/update', 'CartController@detupdateCart');
Route::post('/detcart/clear', 'CartController@detdestroyCart');
Route::get('/detcart/dish/remove', 'CartController@detremoveDish');

//Payment Method
Route::post('/cart/checkout', 'OrdersController@checkout');
Route::post('/cart/order', 'OrdersController@store')->name('order.place');
Route::post('/cart/pay', 'OrdersController@payment')->name('order.payment');
Route::post('/initCustomer', 'OrdersController@initCustomer');

Route::prefix('user')->group(function() {
	// User Profile
	Route::get('/profile/{id}', 'UserProfController@show')->name('user.profile');
	Route::post('/{id}', 'UserProfController@update')->name('profile.update');
	Route::post('/allergen/{id}', 'UserProfController@update2')->name('allergies.update');
	Route::post('/AddAller/{id}', 'UserProfController@storeAllergen')->name('allergen.add');
	Route::post('/Allergen/delete', 'UserProfController@destroyA')->name('aller.destroy');
	Route::post('/MedCon/delete', 'UserProfController@destroyM')->name('aller.destroyM');
	Route::post('/AddMed/{id}', 'UserProfController@storeMedcon')->name('medcon.add');
	Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
	Route::post('/Adduserimg/{id}', 'UserProfController@storeUserImg')->name('user.img');
	Route::get('/changepass', 'UserProfController@resetPassword')->name('user.changepass');
	Route::post('/change/password', 'UserProfController@changePassword')->name('user.reset');
	
	
	//Calendar Routes
	Route::get('/calendar', 'PlannedMController@storePlans')->name('user.storeplans');
	Route::get('/calendar/fetch', 'PlannedMController@fetchPlans')->name('user.fetch');
	Route::get('/calendar/update', 'PlannedMController@resetDate')->name('user.resetdate');
	Route::get('/calendar/delete', 'PlannedMController@deletePlan')->name('user.delete');
	Route::get('/calendar/addnotes', 'PlannedMController@addNote')->name('user.addnote');

	//RATINGS
	Route::post('/user/cook/rating', 'DishRatingController@storeCookR')->name('dish.cook.addRating');
	Route::post('/user/cook/pmorderrating', 'DishRatingController@storeCookR2')->name('dish.cook.addRating2');
	Route::post('/user/add/rating', 'DishRatingController@storeRating')->name('dish.addRating');
	Route::post('/user/order/rating', 'DishRatingController@storeRating2')->name('dish.addRating2');
	Route::post('/user/pmorder/rating', 'DishRatingController@storeRating3')->name('dish.addRating3');
	Route::get('/user/order/review/{id}', 'DishRatingController@showRate')->name('dish.orderReview');
	Route::get('/user/pmorder/review/{id}', 'DishRatingController@showRatepm')->name('dish.pmorderReview');
	Route::get('/user/cook/review/{id}', 'DishRatingController@showCookRate')->name('user.cookReview');
	Route::get('/user/cook/pmreview/{id}', 'DishRatingController@showCookRate2')->name('user.cookReview2');
	Route::get('/user/order/confirm', 'DishRatingController@showConfirm')->name('user.confirmorder');
	Route::get('/user/pmorder/confirm', 'DishRatingController@showConfirmpm')->name('user.confirmpmorder');

	//Order Status
	Route::get('/orderstatus', 'OrdersController@show')->name('order.orderhistory');
	Route::post('/order/updatestatus/{id}', 'OrdersController@changeToReceived')->name('order.statuschange');
	Route::post('/order/updatetodone/{id}', 'OrdersController@changeToDone')->name('order.donestatus');
	Route::get('/pastorders', 'OrdersController@pastOrders')->name('order.pastorders');
});


//Planned Meals
Route::get('/braintree/token', 'PlannedMController@token');
Route::get('/plannedm', 'PlannedMController@index1')->name('user.plan.home');
Route::post('/pmeals', 'PlannedMController@index')->name('user.plan.index');
Route::post('/newplan', 'PlannedMController@storeEvent')->name('user.plan.store');
Route::get('/summary', 'PlannedMController@summary')->name('user.pmsummary');
Route::get('/mode', 'PlannedMController@modeOfDelivery')->name('user.modeofdel');
Route::post('/summary/setdetails', 'PlannedMController@updatePm')->name('user.setDetails');
Route::post('/pmeals/setdetails', 'PlannedMController@updateTimePm')->name('user.pmdetails');

//PLANNED MEALS PAYMENT
Route::get('/pmeals/payment','PmOrdersController@checkout')->name('user.payment'); //route to payment blade
Route::post('pmeals/store', 'PmOrdersController@store')->name('user.pmstore');
Route::post('/pmeals/pay', 'PmOrdersController@payment')->name('user.pmpayment');

Route::post('braintree/webhooks','\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook');

//Order Status
Route::get('/orderstatus/plannedmeal', 'OrdersController@showPm')->name('pmorder.orderhistory');
Route::get('/orderstatus/plannedmeal', 'OrdersController@showPm')->name('pmorder.orderhistory');
Route::post('/pmorder/updatestatus/{id}', 'OrdersController@pmchangeToReceived')->name('pmorder.statuschange');
Route::get('/pmpastorders', 'OrdersController@pmpastOrders')->name('pmorder.pastorders');



Route::prefix('cook')->group(function() {
	// Registration routes
	Route::get('/login', 'Auth\CookLoginController@show')->name('cook.login');
	Route::post('/login', 'Auth\CookLoginController@login')->name('cook.login.submit');
	Route::get('/register', 'Auth\CookRegisterController@index')->name('cook.register');
	Route::post('/register', 'Auth\CookRegisterController@create')->name('cook.register.submit');
	Route::get('/', 'CookController@index')->name('cook.dashboard');
	Route::post('/', 'CookController@index')->name('cook.sort');
	Route::get('/logout', 'Auth\CookLoginController@logout')->name('cook.logout');
	
	//Password reset routes
	Route::post('/password/email', 'Auth\CookForgotPasswordController@sendResetLinkEmail')->name('cook.password.email');
	Route::get('/password/reset', 'Auth\CookForgotPasswordController@showLinkRequestForm')->name('cook.password.request');
	Route::get('/password/reset/{token}', 'Auth\CookResetPasswordController@showResetForm')->name('cook.password.reset');
	Route::post('/password/reset', 'Auth\CookResetPasswordController@reset');

	
	//Orders
	Route::get('orders/eodetails', function(){
        return view('cook.vieweorder');
	});
	Route::get('orders/express', 'CookController@showExOrders')->name('cook.expressorders');
	Route::get('orders/planned', 'CookController@fetch')->name('cook.porders');
	Route::get('orders/planned/{id}/{planid}', 'CookController@showPlanOrders')->name('cook.planorder');
	
	//Dishes
	Route::get('/dishes/addCatalog', 'DishController@addCatalog')->name('dish.catalog');
	Route::post('/dishes/createCatalog', 'DishController@createCatalog')->name('dish.catalog.create');
	Route::get('dishes', 'DishController@index')->name('cook.dishes');
	Route::get('dishes/add', 'DishController@create')->name('cook.dishes.add');
	Route::post('dishes/create', 'DishController@store')->name('cook.dishes.create');
	Route::get('dishes/{id}', 'DishController@show')->name('cook.dishes.show');
	Route::post('dishes/{id}', 'DishController@update')->name('cook.dishes.update');
	Route::post('dishes/delete/{id}', 'DishController@destroy')->name('cook.dishes.delete');
	Route::post('dishes/update/{id}', 'DishController@update')->name('cook.dishes.update');
	Route::get('dishes/edit/{id}', 'DishController@edit')->name('cook.dishes.edit');
    Route::get('dishes/reviews/{id}', 'DishController@viewrating')->name('cook.rating');
        
	Route::get('/displayDishes', 'DishController@searchDishes')->name('display');
	Route::get('/previewDishes/{id}', 'DishController@previewDish')->name('preview');
	Route::get('/searchIngredients', 'DishController@searchIngredient')->name('search.ingredient');
	Route::post('/status', 'CookController@changeAvailabilityStat')->name('status.change');
	Route::post('/orderstat', 'CookController@changeOrderStats')->name('orderstat.change');
	Route::get('reviews', 'CookController@cookviewrating')->name('cook.view.ratings');

	Route::get('/viewmakeplan', 'DishController@viewPlan')->name('cook.view.plan');
	Route::post('/addplan', 'DishController@storePlan')->name('cook.addPlan');
	Route::get('/pmdishes', 'DishController@pmindex')->name('cook.pmdishes');
	Route::get('/createplan', 'DishController@createPlan')->name('cook.create.plan');
	Route::post('/makeplan', 'DishController@makePlan')->name('cook.make.plan');
	Route::get('/editplan', 'DishController@editPlan')->name('cook.edit.plan');
	Route::post('/updateplan', 'DishController@updatePlan')->name('cook.update.plan');


        
});

Route::get('/matrix', 'AdminController@matrix')->name('matrix');
//Admin
Route::prefix('admin')->group(function() {
	Route::get('/', 'AdminController@index')->name('admin.home');
	Route::get('/imp/{username}', 'AdminLoginController@imp');
	
	Route::get('/unitTest' , 'AdminController@unitTest');

	// Registration routes
	Route::get('/login', 'Auth\AdminLoginController@show')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	//Add
	Route::post('/addAllergen', 'AdminController@storeAllergens')->name('add.allergen');
	Route::post('/addMedcon', 'AdminController@storeMedCon')->name('add.medcon');
	Route::post('/addPreparation', 'AdminController@storePreparation')->name('add.prep');
	Route::post('/addMeasurement', 'AdminController@storeMeasurement')->name('add.measure');
	Route::post('/addBestEaten', 'AdminController@storeBestEaten')->name('add.best');
	Route::post('/addTolerance', 'AdminController@storeTolerance')->name('add.tolerance');
	//Update
	Route::post('/updateAllergen/{id}', 'AdminController@updateAllergens')->name('update.allergen');
	Route::post('/updateMedCon/{id}', 'AdminController@updateMedCon')->name('update.medcon');
	Route::post('/updatePreparation/{id}', 'AdminController@updatePreparation')->name('update.prep');
	Route::post('/updateMeasurement/{id}', 'AdminController@updateMeasurement')->name('update.measure');
	Route::post('/updateBestEaten/{id}', 'AdminController@updateBestEaten')->name('update.best');
	//Delete
	Route::post('/deleteAllergen' , 'CoachingFormController@deleteAllergen');
	Route::post('/deleteMedCon' , 'CoachingFormController@deleteMedCon');
	Route::post('/deletePreparation' , 'CoachingFormController@deletePreparation');
	Route::post('/deleteMeasurement' , 'CoachingFormController@deleteMeasurement');
	Route::post('/deleteBestEaten' , 'CoachingFormController@deleteBestEaten');

});
