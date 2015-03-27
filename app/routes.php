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

Route::get('/auth/forgot', array(
	'as' => 'auth.forgot',
	'before' => 'guest',
	'uses' => 'AuthController@forgot',
));

Route::post('/auth/forgot/send', array(
	'as' => 'auth.forgot.send',
	'before' => 'guest',
	'uses' => 'AuthController@forgotSend',
));

Route::get('/auth/change/{token}', array(
	'as' => 'auth.forgot.change',
	'before' => 'guest',
	'uses' => 'AuthController@changePassword',
));

Route::post('/auth/forgot/{token}', array(
	'as' => 'auth.forgot.check',
	'before' => 'guest',
	'uses' => 'AuthController@forgotCheck',
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
		'before' => 'csrf|auth.isUser',
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
		'before' => 'csrf|auth.isUser',
		'uses' => 'UserController@update',
	));

	Route::delete('/users/{id}', array(
		'as' => 'users.destroy',
		'before' => 'csrf|auth.isUser',
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

	Route::post('/analytics', array(
		'as' => 'analytics',
		'uses' => 'DashboardController@getAnalytics',
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
		'before' => 'auth.isDeveloper',
		'uses' => 'CollectionController@create',
	));

	Route::post('/collections', array(
		'as' => 'collections.store',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'CollectionController@store',
	));

	Route::get('/collections/{id}', array(
		'as' => 'collections.show',
		'uses' => 'CollectionController@show',
	));

	Route::get('/collections/{id}/edit', array(
		'as' => 'collections.edit',
		'before' => 'auth.isDeveloper',
		'uses' => 'CollectionController@edit',
	));

	Route::put('/collections/{id}', array(
		'as' => 'collections.update',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'CollectionController@update',
	));

	Route::delete('/collections/{id}', array(
		'as' => 'collections.destroy',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'CollectionController@destroy',
	));

	Route::post('/collections/addField', array(
		'as' => 'collections.addField',
		'before' => 'auth.isDeveloper',
		'uses' => 'CollectionController@addField',
	));

	Route::post('/collections/addCollectionFields', array(
		'as' => 'collections.addCollectionFields',
		'before' => 'auth.isDeveloper',
		'uses' => 'CollectionController@addCollectionFields',
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

	Route::post('/registers/{slug}/reorder', array(
		'as' => 'registers.reorder',
		'uses' => 'RegisterController@reorder',
	));

	
	
	/*
	|--------------------------------------------------------------------------
	| Pages Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/pages', array(
		'as' => 'pages',
		'uses' => 'PageController@index',
	));

	Route::get('/pages/create', array(
		'as' => 'pages.create',
		'before' => 'auth.isDeveloper',
		'uses' => 'PageController@create',
	));

	Route::post('/pages', array(
		'as' => 'pages.store',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'PageController@store',
	));

	Route::get('/pages/{id}/edit', array(
		'as' => 'pages.edit',
		'before' => 'auth.isDeveloper',
		'uses' => 'PageController@edit',
	));

	Route::put('/pages/{id}', array(
		'as' => 'pages.update',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'PageController@update',
	));

	Route::delete('/pages/{id}', array(
		'as' => 'pages.destroy',
		'before' => 'csrf|auth.isDeveloper',
		'uses' => 'PageController@destroy',
	));

	Route::post('/pages/addField', array(
		'as' => 'pages.addField',
		'before' => 'auth.isDeveloper',
		'uses' => 'PageController@addField',
	));

	Route::post('/pages/addCollectionFields', array(
		'as' => 'pages.addCollectionFields',
		'before' => 'auth.isDeveloper',
		'uses' => 'PageController@addCollectionFields',
	));

	Route::post('/pages/search', array(
		'as' => 'pages.search',
		'uses' => 'PageController@search',
	));


});

