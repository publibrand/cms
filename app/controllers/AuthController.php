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

	public function forgot() {

		return View::make('auth.forgot');
		
	}

	private function generateToken($user) {
		return base64_encode(serialize([
			'user' => $user->id,
			'token' => $user->getResetPasswordCode(),
		]));
	}

	private function decodeToken($token) {
		return unserialize(base64_decode($token));
	}

	public function forgotSend() {

		$labels = [
			'email' => 'E-mail',
		];

		$rules = [
            'email' => 'required|email',
		];

		$validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		try {

			$user = Sentry::findUserByLogin(Input::get('email'));
			$token = $this->generateToken($user);

			Mail::send('emails.forgot', [
				'user' => $user,
				'token' => $token
			], function($message) use($user) {
			    $message->to($user->email, $user->first_name)
			    	 	->subject('Forgot password');
			});

		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

			return Response::json([
				'errorMessage' => 'User was not found',
            ], 400); 

		}

		return Response::json([
			'redirect' => url('/'),
			'timeout' => 1000,
        ], 200); 

	}

	public function changePassword($token) {

		return View::make('auth.change')
				   ->with('token', $token);

	}

	public function forgotCheck($token) {

		$labels = [
			'password' => 'Password',
	    	'password_confirmation' => 'Password confirmation',
		];

		$rules = [
        	'password' => 'required',
	    	'password_confirmation' => 'required|same:password',
		];

		$validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$token = $this->decodeToken($token);

		try {
			$user = Sentry::findUserById($token['user']);

			if ($user->checkResetPasswordCode($token['token'])) {
				if ($user->attemptResetPassword($token['token'], Input::get('password'))) {
					
					return Response::json([
						'redirect' => url('/'),
						'timeout' => 1000,
			        ], 200); 
			        
				} else {

					return Response::json([
						'errorMessage' => 'Token not found',
		            ], 400); 

				}
			} else {

			}
		} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {

			return Response::json([
				'errorMessage' => 'User not found',
            ], 400); 

		}

		return Response::json([
			'redirect' => url('/'),
			'timeout' => 1000,
        ], 200); 

	}

}
