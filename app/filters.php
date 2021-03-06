<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request) {

	if(Sentry::check()) {
		View::share('authUserGroup', User::getGroup());
		View::share('menu', BaseController::getMenuItems());
	}
	
});


App::after(function($request, $response) {
	//
});

App::missing(function($exception) {
	return Response::view('errors.missing', array(), 404);
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function() {

	if (Sentry::check() === FALSE) {
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('auth');
		}
	}
	
});

Route::filter('auth.isUser', function($route, $request) {

	$user = Sentry::getUser();
	$isDeveloper = Route::callRouteFilter('auth.isDeveloper', [], $route, $request);
	$isEditor = Route::callRouteFilter('auth.isEditor', [], $route, $request);

	if(empty($isDeveloper) || empty($isEditor)) {
		return;
	}	
	
	if ((int) $user->id !== (int) $route->getParameter('id')) {
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('/');
		}
	}

});

Route::filter('auth.isDeveloper', function($route) {
	
	$user = Sentry::getUser();
	
	if(!User::inGroup('Developer', $user->id)) {
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('/');
		}
	} 

});

Route::filter('auth.isEditor', function($route) {
	
	$user = Sentry::getUser();

	if(!User::inGroup('Editor', $user->id)) {
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::to('/');
		}
	} 

});

Route::filter('guest', function() {
	
	if (Sentry::check()) return Redirect::to('/');
	
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function() {

	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	
	if (Session::token() !== $token) {
		throw new Illuminate\Session\TokenMismatchException;
	}

});
