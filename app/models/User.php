<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function hasAccess($permissions, $id = NULL) {

		$permissions = (array) $permissions;

		if($id == NULL) {

			$user = Sentry::getUser();

		}  else {

			$user = Sentry::findUserById($id);

		}

		foreach($permissions as $permission) {
			if($user->hasAccess($permission) == FALSE) {
				return FALSE;
			}
		} 

		return TRUE;

	}

	public static function inGroup($group, $id = NULL) {

		if($id == NULL) {

			$user = Sentry::getUser();

		}  else {

			$user = Sentry::findUserById($id);

		}

		$group = Sentry::findGroupByName($group);

	    if ($user->inGroup($group)) {

	    	return TRUE;

	    }


	}

	public static function getGroup($id = NULL) {

		if($id == NULL) {

			$user = Sentry::getUser();

		}  else {

			$user = Sentry::findUserById($id);

		}

		foreach($user->getGroups() as $group) {

			return $group;

		}

	}

}
