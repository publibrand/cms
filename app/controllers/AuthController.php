<?php

class AuthController extends BaseController {

	public function login() {
		
		return View::make('auth.index');

	}

	public function check() {

		$labels = [
			'email' => 'E-mail',
    		'password' => 'Password',
		];

		$rules = [
            'email' => 'required|email',
	    	'password' => 'required',
		];

        $validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

	    $remember = Input::get('remember') ? Input::get('remember') : FALSE;

	    try{

		    $user = Sentry::authenticate([
	        	'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    ], $remember);

		    return Response::json([
				'redirect' => route('dashboard'),
				'timeout' => 1000,
	        ], 200); 

	    } catch(Cartalyst\Sentry\Users\WrongPasswordException $e) {

	    	$errorMessage = 'Wrong password, try again.';

	    } catch(Cartalyst\Sentry\Users\UserNotFoundException $e) {

	    	$errorMessage = 'User was not found.';
	    }

		return Response::json([
			'errorMessage' => $errorMessage,
    	], 400); 

	}

	public function logout() {
		
		Sentry::logout();

		return Redirect::to('/');

	}

	public function lost() {

		
		
	}

}
