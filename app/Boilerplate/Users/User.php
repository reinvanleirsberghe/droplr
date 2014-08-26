<?php namespace Boilerplate\Users;

use Boilerplate\Users\Events\UserRegistered;
use Boilerplate\Users\Events\UserUpdated;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent, Hash;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator, DispatchableTrait;

	/**
	 * which fields may be massassigned?
	 * @var array
	 */
	protected $fillable = ['firstname', 'name', 'email', 'password', 'remember_token'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * A user has many drops
	 *
	 * @return mixed
	 */
	public function drops()
	{
		return $this->hasMany('Boilerplate\Drops\Drop');
	}

	/**
	 * Has the password
	 *
	 * @param $password
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

	/**
	 * Register a user
	 *
	 * @param $firstname
	 * @param $name
	 * @param $email
	 * @param $password
	 * @return static
	 */
	public static function register($firstname, $name, $email, $password)
	{
		$user = new static(compact('firstname', 'name', 'email', 'password'));

		// raise event
		$user->raise(new UserRegistered($user));

		return $user;
	}

	/**
	 * Update a user account
	 *
	 * @param $firstname
	 * @param $name
	 * @param $email
	 * @return static
	 */
	public static function updateUser($firstname, $name, $email)
	{
		$user = new static(compact('firstname', 'name', 'email'));

		// raise event
		$user->raise(new UserUpdated($user));

		return $user;
	}

}
