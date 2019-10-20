<?php


Route::get('/', 'WelcomeController@index')->name('welcome');

/*Administrator*/
Route::get('/board-login', 'AdminAuthController@loginView')->name('board-login-view');
Route::post('/board-login', 'AdminAuthController@login')->name('board-login');


//Customer
Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/customer-profile', 'HomeController@profile')->name('customer-profile');
Route::patch('/customer-profile/{customer}', 'HomeController@updateProfile')->name('customer-update');
Route::post('/customer-logout', 'Auth\LoginController@logout')->name('customer-logout');


//Dashboard
Route::get('/administrator-dashboard', 'AdministratorController@index')->name('administrator-dashboard');
Route::get('/administrator-profile', 'AdministratorController@profile')->name('administrator-profile');
Route::patch('/administrator-profile/{administrator}', 'AdministratorController@update')->name('administrator-update');
Route::post('/administrator-logout', 'AdminAuthController@logout')->name('administrator-logout');


//Categories
Route::get('/categories', 'CategoriesController@index');
Route::post('/category/store', 'CategoriesController@store');


//Prouducts 
Route::get('/products', 'ProductsController@index')->name('products');
Route::get('/products/create', 'ProductsController@create')->name('products.create');
Route::post('/products', 'ProductsController@store')->name('products.store');
Route::get('/products/{products}-{slug}', 'ProductsController@show')->name('products.show');
Route::get('/products-edit/{products}-{slug}', 'ProductsController@edit')->name('products.edit');
Route::patch('/products/{products}/update', 'ProductsController@update')->name('products.update');
Route::post('/products/{products}', 'ProductsController@destroy')->name('products.delete');


//Customers
Route::get('/customers', 'CustomerController@index')->name('customers');
Route::get('/customers/{customer}-{slug}', 'CustomerController@show')->name('customer.show');
Route::post('/customers/{customer}', 'CustomerController@destroy')->name('customer.delete');


//Search
Route::get('searchall/{param}', 'SearchController@search');
Route::get('searchProducts/{param}', 'SearchController@searchProuducts');
Route::get('searchCustomers/{param}', 'SearchController@searchCustomers');