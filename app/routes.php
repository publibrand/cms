<?php

Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

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

Route::get('/auth/lost', array(
	'as' => 'auth.lost',
	'before' => 'guest',
	'uses' => 'AuthController@lost',
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

	Route::get('/users/{id}', array(
		'as' => 'users.show',
		'uses' => 'UserController@show',
	));

	Route::get('/users/{id}/edit', array(
		'as' => 'users.edit',
		'before' => 'auth.isUser',
		'uses' => 'UserController@edit',
	));

	Route::put('/users/{id}', array(
		'as' => 'users.update',
		'before' => 'csrf',
		'uses' => 'UserController@update',
	));

	Route::delete('/users/{id}', array(
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

	Route::get('/collections/{id}', array(
		'as' => 'collections.show',
		'uses' => 'CollectionController@show',
	));

	Route::get('/collections/{id}/edit', array(
		'as' => 'collections.edit',
		'uses' => 'CollectionController@edit',
	));

	Route::put('/collections/{id}', array(
		'as' => 'collections.update',
		'before' => 'csrf',
		'uses' => 'CollectionController@update',
	));

	Route::delete('/collections/{id}', array(
		'as' => 'collections.destroy',
		'before' => 'csrf',
		'uses' => 'CollectionController@destroy',
	));

	Route::post('/collections/addField', array(
		'as' => 'collections.addField',
		'uses' => 'CollectionController@addField',
	));

	Route::post('/collections/search', array(
		'as' => 'collections.search',
		'uses' => 'CollectionController@search',
	));

	/*
	|--------------------------------------------------------------------------
	| Registers Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/registers/{slug}', array(
		'as' => 'registers',
		'uses' => 'RegisterController@index',
	));

	Route::get('/registers/{slug}/create', array(
		'as' => 'registers.create',
		'uses' => 'RegisterController@create',
	));

	Route::post('/registers/{slug}', array(
		'as' => 'registers.store',
		'before' => 'csrf',
		'uses' => 'RegisterController@store',
	));

	Route::get('/registers/{slug}/{id}', array(
		'as' => 'registers.show',
		'uses' => 'RegisterController@show',
	));

	Route::get('/registers/{slug}/{id}/edit', array(
		'as' => 'registers.edit',
		'uses' => 'RegisterController@edit',
	));

	Route::put('/registers/{slug}/{id}', array(
		'as' => 'registers.update',
		'before' => 'csrf',
		'uses' => 'RegisterController@update',
	));

	Route::delete('/registers/{slug}/{id}', array(
		'as' => 'registers.destroy',
		'before' => 'csrf',
		'uses' => 'RegisterController@destroy',
	));

});

