<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/auth', array(
	'as' => 'auth',
	'before' => 'guest',
	'uses' => 'AuthController@login',
));

Route::post('/auth', array(
	'as' => 'auth.check',
	'before' => 'guest',
	'uses' => 'AuthController@check',
));

Route::get('/auth/logout', array(
	'as' => 'auth.logout',
	'uses' => 'AuthController@logout',
));

/*
|--------------------------------------------------------------------------
| Security Routes
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'auth'), function() {

	/*
	|--------------------------------------------------------------------------
	| User Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/users', array(
		'as' => 'users',
		'uses' => 'UserController@index',
	));

	Route::get('/profile', array(
		'as' => 'users.profile',
		'uses' => 'UserController@profile',
	));

	Route::get('/users/create', array(
		'as' => 'users.create',
		'uses' => 'UserController@create',
	));

	Route::post('/users', array(
		'as' => 'users.store',
		'before' => 'csrf',
		'uses' => 'UserController@store',
	));

	Route::get('/users/{user}', array(
		'as' => 'users.show',
		'uses' => 'UserController@show',
	));

	Route::get('/users/{user}/edit', array(
		'as' => 'users.edit',
		'before' => 'auth.isUser',
		'uses' => 'UserController@edit',
	));

	Route::put('/users/{user}', array(
		'as' => 'users.update',
		'before' => 'csrf',
		'uses' => 'UserController@update',
	));

	Route::delete('/users/{user}', array(
		'as' => 'users.destroy',
		'before' => 'csrf',
		'uses' => 'UserController@destroy',
	));

	/*
	|--------------------------------------------------------------------------
	| Dashboard Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/', array(
		'as' => 'dashboard',
		'uses' => 'DashboardController@index',
	));

	/*
	|--------------------------------------------------------------------------
	| Collections Routes
	|--------------------------------------------------------------------------
	*/


	Route::get('/collections', array(
		'as' => 'collections',
		'uses' => 'CollectionController@index',
	));

	Route::get('/collections/create', array(
		'as' => 'collections.create',
		'uses' => 'CollectionController@create',
	));

	Route::post('/collections', array(
		'as' => 'collections.store',
		'before' => 'csrf',
		'uses' => 'CollectionController@store',
	));

	Route::get('/collections/{collection}', array(
		'as' => 'collections.show',
		'uses' => 'CollectionController@show',
	));

	Route::get('/collections/{collection}/edit', array(
		'as' => 'collections.edit',
		'uses' => 'CollectionController@edit',
	));

	Route::put('/collections/{collection}', array(
		'as' => 'collections.update',
		'before' => 'csrf',
		'uses' => 'CollectionController@update',
	));

	Route::delete('/collections/{collection}', array(
		'as' => 'collections.destroy',
		'before' => 'csrf',
		'uses' => 'CollectionController@destroy',
	));

});

