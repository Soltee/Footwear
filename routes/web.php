
<?php


Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/categories', 'WelcomeController@categories');
Route::get('/searchShoes/{shoes}', 'WelcomeController@searchShoes');
Route::get('/shoes', 'WelcomeController@shoes')->name('shoes');
Route::get('/shoes/{products}-{slug}', 'WelcomeController@show')->name('show');
Route::post('/add-cart/{products}', 'CartController@addProduct');

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
Route::patch('/customer-pic/{customer}', 'HomeController@profilePic')->name('customer-pic');
Route::post('/customer-logout', 'Auth\LoginController@logout')->name('customer-logout');

//Customer Checkout Process 
Route::get('/cart-details', 'CartController@show')->name('cart.show');
Route::get('/checkout', 'CheckoutController@checkout')->name('cart.checkout');
Route::post('/charge', 'CheckoutController@charge')->name('cart.charge');
Route::get('/thank-you', 'CheckoutController@thankyou')->name('thank-you');


//Dashboard
Route::prefix('admin')->group(function () {

	/*Administrator*/
	Route::get('/login', 'Administrator\AdminAuthController@loginView')->name('board-login-view');
	Route::post('/login', 'Administrator\AdminAuthController@login')->name('board-login');

	Route::get('/dashboard', 'Administrator\AdministratorController@index')->name('administrator-dashboard');
	Route::get('/profile', 'Administrator\AdministratorController@profile')->name('administrator-profile');
	Route::patch('/administrator-profile/{administrator}', 'Administrator\AdministratorController@update')->name('administrator-update');
	Route::post('/administrator-logout', 'Administrator\AdminAuthController@logout')->name('administrator-logout');


	//Categories
	Route::get('/categories', 'Administrator\CategoryController@index');
	Route::post('/category/store', 'Administrator\CategoryController@store');

	//Category Api
	Route::get('/getCategories', 'Administrator\CategoryController@getCategories');
	Route::get('/getSubCategories/{category}', 'SubCategoryController@index');

	//Prouducts 
	Route::get('/products', 'Administrator\ProductController@index')->name('products');
	Route::get('/products/create', 'Administrator\ProductController@create');
	Route::get('/products-edit/{product}-{slug}', 'Administrator\ProductController@edit')->name('products.edit');

	//Products Api
	Route::get('/getProducts', 'Administrator\ProductController@getProducts');
	Route::get('/products/{product}', 'Administrator\ProductController@show');
	Route::post('/products', 'Administrator\ProductController@store');
	Route::patch('/products/{product}', 'Administrator\ProductController@update');
	Route::delete('/products/{product}', 'Administrator\ProductController@destroy');

	//ProductImageApi
	Route::get('/productsImage/{product}', 'ProductImagesController@index');	
	Route::delete('/productsImage/{ProductImages}', 'ProductImagesController@destroy');

	//Customers
	Route::get('/customers', 'Administrator\CustomerController@index')->name('customers');
	
	//CustomerApi
	Route::get('/getCustomers', 'Administrator\CustomerController@get');
	Route::get('/customers/{customer}', 'Administrator\CustomerController@show');
	Route::delete('/customers/{customer}', 'Administrator\CustomerController@destroy');

	//Search
	Route::get('/searchall/{param}', 'Administrator\SearchController@search');
	Route::get('/searchProducts/{param}', 'Administrator\SearchController@searchProuducts');
	Route::get('/searchCustomers/{param}', 'Administrator\SearchController@searchCustomers');

});
