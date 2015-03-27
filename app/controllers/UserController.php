<?php

class UserController extends BaseController {

	public function index() {
		
		$users = User::all();

		return View::make('dashboard.users.index')
				   ->with('users', $users);
                   
	}

	private function getPermissions() {

		$permissions = [];
		$collections = Collection::all();

		foreach($collections as $collection) {
			$name = strtolower($collection->name);

			$permissions[] = $name . ".create";
			$permissions[] = $name . ".update";
			$permissions[] = $name . ".show";
			$permissions[] = $name . ".delete";

		}		

		return $permissions;

	}

	private function getGroups() {

		$groups = [];

		foreach(Sentry::findAllGroups() as $group) {
			$groups[$group->id] = $group->name;
		}

		return $groups;

	}

	public function create() {

		return View::make('dashboard.users.create')
				   ->with('groups', $this->getGroups())
				   ->with('permissions', $this->getPermissions());

	}


	public function store() {

		$password=Str::random(8);
		
		$labels = [
			'first_name' => 'First name',
	    	'last_name' => 'Last name',
	    	'email' => 'E-mail',
		];

		$rules = [
            'first_name' => 'required',
	    	'last_name' => 'required',
	    	'email' => 'required|email|unique:users',
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
	        'password'  => $password,
	        'activated' => TRUE,
	    ]);

	    $group = Sentry::findGroupById(Input::get('group'));

	    $user->addGroup($group);

		Mail::send('emails.new-user', [
			'user' => $user->email,
			'password' => $password
		], function($message) use($user) {
			$message->to($user->email, $user->first_name)
					->subject('New user');
		});
		
		
    	return Response::json([
			'redirect' => route('auth'),
			'timeout' => 1000,
        ], 200); 

	}


	public function profile(){

		$user = Sentry::getUser();
		$group = User::getGroup($user->id);

		return View::make('dashboard.users.edit')
				   ->with('user', $user)
				   ->with('userGroup', $group)
				   ->with('groups', $this->getGroups());

	}

	public function show($id){

		$user = User::find($id);

		return View::make('dashboard.users.index')
				   ->with('user', $user);

	}

	public function edit($id) {

		$user = Sentry::findUserByID($id);
		$group = User::getGroup($id);
	
		return View::make('dashboard.users.edit')
				   ->with('user', $user)
				   ->with('userGroup', $group)
				   ->with('groups', $this->getGroups());
	
	}

	public function update($id) {

		$user = Sentry::findUserByID($id);

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

		if(Input::has('group')) {
			$group = User::getGroup($id);
			$user->removeGroup($group);
			
			$group = Sentry::findGroupById(Input::get('group'));
			$user->addGroup($group);
		}

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
