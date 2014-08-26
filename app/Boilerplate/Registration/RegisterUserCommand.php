<?php namespace Boilerplate\Registration;

class RegisterUserCommand {

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
	public $password;

	/**
	 * @param $firstname
	 * @param $name
	 * @param $email
	 * @param $password
	 */
	function __construct($firstname, $name, $email, $password)
	{
		$this->firstname = $firstname;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}

}