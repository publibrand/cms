<?php

class UserController extends BaseController {

	public function index() {
		
		$users = User::all();

		return View::make('dashboard.users.index')
				   ->with('users', $users);
                   
	}

	public function create() {

		return View::make('dashboard.users.create');

	}


	public function store() {

		$labels = [
			'first_name' => 'First name',
	    	'last_name' => 'Last name',
	    	'email' => 'E-mail',
	    	'password' => 'Password',
	    	'password_confirmation' => 'Password confirmation',
		];

		$rules = [
            'first_name' => 'required',
	    	'last_name' => 'required',
	    	'email' => 'required|email|unique:users',
	    	'password' => 'required',
	    	'password_confirmation' => 'required|same:password',
		];

        $validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
    			'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$user = Sentry::createUser([
			'first_name' => Input::get('first_name'),
			'last_name' => Input::get('last_name'),
	        'email'     => Input::get('email'),
	        'password'  => Input::get('password'),
	        'activated' => TRUE,
	    ]);

    	return Response::json([
			'redirect' => route('auth'),
			'timeout' => 1000,
        ], 200); 

	}


	public function profile(){

		$user = Sentry::getUser();

		return View::make('dashboard.users.profile')
				   ->with('user', $user);

	}

	public function show($id){

		$user = User::find($id);

		return View::make('dashboard.users.index')
				   ->with('user', $user);

	}

	public function edit($id) {

		$user = User::find($id);

		return View::make('dashboard.users.edit')
				   ->with('user', $user);
	
	}

	public function update($id) {

		$user = User::find($id);

		$labels = [
			'first_name' => 'First name',
	    	'last_name' => 'Last name',
	    	'email' => 'E-mail',
	    	'password' => 'Password',
	    	'password_confirmation' => 'Password confirmation',
		];

		$rules = [
            'first_name' => 'required',
	    	'last_name' => 'required',
		];

		if(Input::has('password')) {
			$rules = array_add($rules, 'password', 'required');
			$rules = array_add($rules, 'password_confirmation', 'required|same:password');
		}

		if(Input::has('email') &&  Input::get('email') !== $user->email) {
			$rules = array_add($rules, 'email', 'unique:users');
		}

        $validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
    			'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');

		if(Input::has('password')) {
			$user->password = Input::get('password');
		}

		$user->save();

    	return Response::json([
			'redirect' => route('auth'),
			'timeout' => 1000,
        ], 200); 

	}

	public function destroy($id) {

		$user = User::find($id);
		$user->delete();

		return Response::json([
			'redirect' => route('auth'),
			'timeout' => 1000,
        ], 200); 

	}

}
