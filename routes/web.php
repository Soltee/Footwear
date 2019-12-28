
<?php


Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/categories', 'WelcomeController@categories');
Route::get('/searchShoes/{shoes}', 'WelcomeController@searchShoes');
Route::get('/shoes', 'WelcomeController@shoes')->name('shoes');
Route::get('/shoes/{products}-{slug}', 'WelcomeController@show')->name('show');

//Cart

Route::get('/add-to-cart/{products}', 'CartController@addProduct');

Route::get('/getCartProducts', 'CartController@getCartProducts');

Route::get('/getUpdatedData', 'CartController@getUpdatedData');

Route::get('/is-already-added/{products}', 'CartController@isProductAlreadyAdded');

Route::post('/clear-cart', 'CartController@clearCart');

Route::post('/remove-from-cart/{products}', 'CartController@removeProduct');

Route::post('/update-cart/{rowId}', 'CartController@updateProduct');
Route::post('/coupon-redeem', 'CouponController@redeem');

//Customer
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/customer-profile', 'HomeController@profile')->name('customer-profile');
Route::patch('/customer-profile/{customer}', 'HomeController@updateProfile')->name('customer-update');
Route::post('/customer-logout', 'Auth\LoginController@logout')->name('customer-logout');

//Customer Checkout Process 
Route::get('/cart-details', 'CartController@show')->name('cart.show');
Route::get('/checkout', 'CheckoutController@checkout')->name('cart.checkout');
Route::post('/charge', 'CheckoutController@charge')->name('cart.charge');
Route::get('/thank-you', 'CheckoutController@thankyou')->name('thank-you');


//Dashboard
Route::prefix('admin')->group(function () {

	/*Administrator*/
	Route::get('/board-login', 'Administrator\AdminAuthController@loginView')->name('board-login-view');
	Route::post('/board-login', 'Administrator\AdminAuthController@login')->name('board-login');

	Route::get('/administrator-dashboard', 'Administrator\AdministratorController@index')->name('administrator-dashboard');
	Route::get('/administrator-profile', 'Administrator\AdministratorController@profile')->name('administrator-profile');
	Route::patch('/administrator-profile/{administrator}', 'Administrator\AdministratorController@update')->name('administrator-update');
	Route::post('/administrator-logout', 'Administrator\AdminAuthController@logout')->name('administrator-logout');


	//Categories
	Route::get('/categories', 'Administrator\CategoriesController@index');
	Route::post('/category/store', 'Administrator\CategoriesController@store');


	//Prouducts 
	Route::get('/products', 'Administrator\ProductsController@index')->name('products');
	Route::get('/products/create', 'Administrator\ProductsController@create')->name('products.create');
	Route::post('/products', 'Administrator\ProductsController@store')->name('products.store');
	Route::get('/products/{products}-{slug}', 'Administrator\ProductsController@show')->name('products.show');
	Route::get('/products-edit/{products}-{slug}', 'Administrator\ProductsController@edit')->name('products.edit');
	Route::patch('/products/{products}/update', 'Administrator\ProductsController@update')->name('products.update');
	Route::post('/products/{products}', 'Administrator\ProductsController@destroy')->name('products.delete');


	//Customers
	Route::get('/customers', 'Administrator\CustomerController@index')->name('customers');
	Route::get('/customers/{customer}-{slug}', 'Administrator\CustomerController@show')->name('customer.show');
	Route::post('/customers/{customer}', 'Administrator\CustomerController@destroy')->name('customer.delete');


	//Search
	Route::get('/searchall/{param}', 'Administrator\SearchController@search');
	Route::get('/searchProducts/{param}', 'Administrator\SearchController@searchProuducts');
	Route::get('/searchCustomers/{param}', 'Administrator\SearchController@searchCustomers');

});
