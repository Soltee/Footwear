<?php


Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/categories', 'WelcomeController@categories');
Route::get('/shoes', 'WelcomeController@shoes')->name('shoes');

//Cart
Route::get('/getCartProducts', 'CartController@getCartProducts');
Route::get('/getUpdatedData', 'CartController@getUpdatedData');
Route::post('/coupon-redeem', 'CouponController@apply');
Route::post('/clear-cart', 'CartController@clearCart');

//Customer
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/customer-profile', 'HomeController@profile')->name('customer-profile');
Route::post('/customer-logout', 'Auth\LoginController@logout')->name('customer-logout');

//Customer Checkout Process 
Route::get('/cart-details', 'CartController@show')->name('cart.show');
Route::get('/checkout', 'CheckoutController@index')->name('cart.checkout');
Route::post('/charge', 'CheckoutController@charge');
Route::get('/aftercheckout', 'CheckoutController@sellmoreProduct');

Route::get('/token', 'CheckoutController@getToken');

//Newsletter
Route::post('/newsletter/signup', 'NewsletterController@store');

//About
Route::get('/faq', 'About\AboutController@faq')->name('faq');
Route::get('/privacy-policy', 'About\AboutController@policy')->name('policy');
Route::get('/sitemap', 'About\AboutController@sitemap')->name('sitemap');

//Carrt
Route::get('/add-to-cart/{products}', 'CartController@addProduct');
Route::get('/is-already-added/{products}', 'CartController@isProductAlreadyAdded');
Route::post('/remove-from-cart/{products}', 'CartController@removeProduct');
Route::post('/update-cart/{rowId}', 'CartController@updateProduct');

//Customer Profile
Route::patch('/customer-profile/{customer}', 'HomeController@updateProfile')->name('customer-update');
Route::patch('/customer-pic/{customer}', 'HomeController@profilePic')->name('customer-pic');

//Review
Route::get('/product/{product}/reviews', 'ProductReviewController@index');
Route::post('/product/{product}/review', 'ProductReviewController@store');

//General
Route::get('/searchShoes/{shoes}', 'WelcomeController@searchShoes');
Route::post('/add-cart/{products}', 'CartController@addProduct');
Route::get('/shoes/{product}/{slug}', 'WelcomeController@show')->name('show');

//Dashboard
Route::prefix('admin')->group(function () {

	/*Administrator*/
	Route::get('/login', 'Administrator\AdminAuthController@loginView')->name('board-login-view');
	Route::post('/login', 'Administrator\AdminAuthController@login')->name('board-login');

	Route::get('/dashboard', 'Administrator\AdministratorController@index')->name('administrator-dashboard');
	Route::get('/profile', 'Administrator\AdministratorController@profile')->name('administrator-profile');
	Route::post('/administrator-logout', 'Administrator\AdminAuthController@logout')->name('administrator-logout');

	//Categories
	Route::get('/categories', 'Administrator\CategoryController@index')->name('categories');

	//Category Api
	Route::get('/getCategories', 'Administrator\CategoryController@getCategories');
	Route::get('/getSubCategories/{category}', 'SubCategoryController@index');
	Route::post('/categories', 'Administrator\CategoryController@store');
	Route::patch('/categories/{category}', 'Administrator\CategoryController@update');
	Route::delete('/categories/{category}', 'Administrator\CategoryController@destroy');

	//SubCategories Api
	Route::get('/getSubCategories', 'SubCategoryController@getSubCategories');
	Route::post('/subcategories', 'SubCategoryController@store');
	Route::patch('/subcategories/{subcategory}', 'SubCategoryController@update');
	Route::delete('/subcategories/{subcategory}', 'SubCategoryController@destroy');

	//Customers
	Route::get('/customers', 'Administrator\CustomerController@index')->name('customers');
	
	//CustomerApi
	Route::get('/getCustomers', 'Administrator\CustomerController@get');

	//Prouducts 
	Route::get('/products', 'Administrator\ProductController@index')->name('products');
	Route::get('/products/create', 'Administrator\ProductController@create');

	//Payments
	Route::get('/payments', 'Administrator\PaymentController@index')->name('payments');

	//Products 
	Route::get('/getProducts', 'Administrator\Api\ProductController@getProducts');
	Route::post('/products', 'Administrator\Api\ProductController@store');
	

	//Customer Api
	Route::get('/customers/{customer}', 'Administrator\CustomerController@show');
	Route::delete('/customers/{customer}', 'Administrator\CustomerController@destroy');


	//Products Api
	Route::get('/products/{product}/show', 'Administrator\ProductController@show')->name('product.show');
	Route::get('/products-edit/{product}-{slug}', 'Administrator\ProductController@edit')->name('products.edit');


	
	//OrderApi
	Route::get('/orders', 'Administrator\OrderController@index');
	Route::get('/orders/{orders}', 'Administrator\OrderController@show');
	Route::delete('/orders/{orders}', 'Administrator\OrderController@destroy');

	//Profle
	Route::patch('/profile/{administrator}', 'Administrator\AdministratorController@update');

	//Products Api
	Route::get('/products/{product}', 'Administrator\Api\ProductController@show');
	Route::patch('/products/{product}', 'Administrator\Api\ProductController@update');
	Route::delete('/products/{product}', 'Administrator\Api\ProductController@destroy');

	//ProductImageApi
	Route::get('/productsImage/{product}', 'ProductImagesController@index');	
	Route::delete('/productsImage/{ProductImages}', 'ProductImagesController@destroy');


	//ProductReview Api
	Route::get('/reviews/{product}', 'Administrator\ProductReviewController@index');

	//Search
	Route::get('/searchall/{param}', 'Administrator\SearchController@search');
	Route::get('/searchProducts/{param}', 'Administrator\SearchController@searchProuducts');
	Route::get('/searchCustomers/{param}', 'Administrator\SearchController@searchCustomers');

});
