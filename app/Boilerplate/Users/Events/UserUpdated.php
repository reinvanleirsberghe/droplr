<?php namespace Boilerplate\Users\Events;

use Boilerplate\Users\User;

class UserUpdated {

	/**
	 * @var \Boilerplate\Users\User
	 */
	public $user;

	/**
	 * @param User $user
	 */
	function __construct(User $user)
	{
		$this->user = $user;
	}
} 