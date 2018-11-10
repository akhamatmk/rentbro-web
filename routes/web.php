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

Route::get('edit/product/{vendor}/{product}', 'Vendor\ProductController@edit_product')->middleware('with.auth');
Route::post('edit/product/{vendor}/{product}', 'Vendor\ProductController@edit_product_store')->middleware('with.auth');

Route::get('set/newPassword/{code}', 'User\UserController@verify_code_new_password')->middleware('with.auth');
Route::get('user/make/newPassword')->uses('User\UserController@send_code_new_password')->middleware('with.auth');
Route::post('make/new/password')->uses('User\UserController@make_new_password')->middleware('with.auth');
Route::post('account/change/password')->uses('User\UserController@change_password_store')->middleware('with.auth');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');


Route::get('category/{alias}', 'CategoryController@product');
Route::get('category', 'CategoryController@index');

Route::get('search', 'SearchController@index')->name('search');

Route::get('wishlist')->uses('WishlistController@list')->middleware('with.auth');
Route::get('wishlist/add')->uses('WishlistController@add');

Route::get('courier', 'ShippingController@courier');

Route::get('invoice/{inv}', 'TransactionController@invoice')->middleware('with.auth');
Route::get('ajax/chart/list', 'ChartController@ajax');
Route::get('chart', 'ChartController@list')->middleware('with.auth');
Route::delete('chart/{chart}', 'ChartController@destroy')->middleware('with.auth');
Route::post('chart', 'ChartController@checkout')->middleware('with.auth');

Route::get('shipping/price', 'ShippingController@price');
Route::get('product/{vendor}/{product}', 'ProductController@detail');
Route::post('product/{vendor}/{product}', 'ProductController@chart')->middleware('with.auth');

Route::get('place/regency', 'PlaceController@regency');
Route::get('place/regency', 'PlaceController@regency');
Route::get('place/district', 'PlaceController@district');

Route::post('product/option/multiple', 'ProductOptionController@multiple');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('validation/{code}')->uses('User\UserController@validation');

Route::get('logout')->uses('Auth\LoginController@logout');

Route::get('login')->uses('Auth\LoginController@index')->name('login')->middleware('no.auth');
Route::post('login')->uses('Auth\LoginController@check')->name('login-post');

Route::get('register')->uses('Auth\LoginController@register')->name('register')->middleware('no.auth');
Route::post('register')->uses('Auth\LoginController@registerPost')->name('register-post');

Route::post('register/by_email')->uses('Auth\LoginController@registerEmailPost')->name('register-post-email');

Route::get('{vendor}/product-add')->uses('Vendor\ProductController@add')->name('product-add')->middleware('with.auth');

Route::post('{nickname}/product-add')->uses('Vendor\ProductController@store')->name('product-add-store');

Route::get('profile')->uses('User\UserController@profile')->name('profile')->middleware('with.auth');
Route::post('profile/edit')->uses('User\UserController@profile_edit_store')->name('profile-edit')->middleware('with.auth');
Route::post('profile/image/change')->uses('User\UserController@profile_image_change')->middleware('with.auth');

Route::get('profile/edit')->uses('User\UserController@profile_edit')->name('profile-edit')->middleware('with.auth');

Route::get('user/menu')->uses('User\UserController@top_menu');

Route::get('category/ajax')->uses('User\ShopController@category');
Route::post('upload/image')->uses('UploadController@imageUpload');
Route::get('account')->uses('User\UserController@profile')->middleware('with.auth');
Route::get('account/address')->uses('User\UserController@address')->middleware('with.auth');
Route::get('account/address/{id}')->uses('User\UserController@detail_address')->middleware('with.auth');
Route::put('account/address/{id}')->uses('User\UserController@edit_address')->middleware('with.auth');
Route::delete('account/address/{id}')->uses('User\UserController@delete_address')->middleware('with.auth');
Route::get('account/change_password')->uses('User\UserController@change_password')->middleware('with.auth');
Route::post('profile/address/add')->uses('User\UserController@address_store')->middleware('with.auth');

Route::get('recomendation/catalog/add')->uses('User\CatalogController@add')->middleware('with.auth');
Route::post('recomendation/catalog/add')->uses('User\CatalogController@store')->middleware('with.auth');

Route::post('check/email')->uses('User\UserController@check_email');
Route::post('check/username')->uses('User\UserController@check_username');

Route::post('validation')->uses('User\UserController@validation_store')->middleware('with.auth');

Route::post('location/{nickname}/vendor/edit', 'User\VendorController@locationEdit')->middleware('with.auth');

Route::group(['prefix' => 'vendor', 'middleware' => ['with.auth']], function(){
	Route::get('/')->uses('User\VendorController@index');
	Route::post('/')->uses('User\VendorController@store');
	Route::get('create')->uses('User\VendorController@create')->name('create-vendor');	

	Route::get('nick_name/check')->uses('User\VendorController@checkNickName');
	Route::get('{nickname}')->uses('User\VendorController@profile');

	Route::get('{nickname}/profile')->uses('User\VendorController@profile');
	Route::get('{nickname}/list_product')->uses('User\VendorController@list_product');

	Route::post('{nickname}/edit/profile')->uses('User\VendorController@edit_profile');
});

Route::post('catalog/{id}')->uses('CatalogController@show_ajax');