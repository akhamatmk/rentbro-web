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
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('place/regency', 'PlaceController@regency');
Route::get('place/district', 'PlaceController@district');

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

Route::post('{vendor_id}/product-add')->uses('Vendor\ProductController@store')->name('product-add-store');

Route::get('profile')->uses('User\UserController@profile')->name('profile')->middleware('with.auth');
Route::post('profile/edit')->uses('User\UserController@profile_edit_store')->name('profile-edit')->middleware('with.auth');
Route::post('profile/image/change')->uses('User\UserController@profile_image_change')->middleware('with.auth');

Route::get('profile/edit')->uses('User\UserController@profile_edit')->name('profile-edit')->middleware('with.auth');

Route::get('user/menu')->uses('User\UserController@top_menu');

Route::get('category/ajax')->uses('User\ShopController@category');

Route::post('upload/image')->uses('UploadController@imageUpload');

Route::get('account')->uses('User\UserController@profile')->middleware('with.auth');
Route::get('account/address')->uses('User\UserController@address')->middleware('with.auth');
Route::get('account/change_password')->uses('User\UserController@change_password')->middleware('with.auth');
Route::post('profile/address/add')->uses('User\UserController@address_store')->middleware('with.auth');

Route::get('recomendation/catalog/add')->uses('User\CatalogController@add')->middleware('with.auth');
Route::post('recomendation/catalog/add')->uses('User\CatalogController@store')->middleware('with.auth');

Route::post('check/email')->uses('User\UserController@check_email');
Route::post('validation')->uses('User\UserController@validation_store')->middleware('with.auth');
Route::group(['prefix' => 'vendor', 'middleware' => ['with.auth']], function(){
	Route::get('/')->uses('User\VendorController@index');
	Route::post('/')->uses('User\VendorController@store');
	Route::get('create')->uses('User\VendorController@create')->name('create-vendor');	

	Route::get('nick_name/check')->uses('User\VendorController@checkNickName');
	Route::get('{nickname}')->uses('User\VendorController@profile');

	Route::get('{nickname}/profile')->uses('User\VendorController@profile');
});