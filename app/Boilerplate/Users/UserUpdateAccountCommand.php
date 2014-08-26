<?php namespace Boilerplate\Users;

class UserUpdateAccountCommand {

	/**
	 * @var
	 */
	public $firstname;

	/**
	 * @var
	 */
	public $name;

	/**
	 * @var
	 */
	public $email;

	/**
	 * @var
	 */
	public $userId;

	/**
	 * @param $firstname
	 * @param $name
	 * @param $email
	 * @param $userId
	 */
	function __construct($firstname, $name, $email, $userId)
	{
		$this->firstname = $firstname;
		$this->name = $name;
		$this->email = $email;
		$this->userId = $userId;
	}

}