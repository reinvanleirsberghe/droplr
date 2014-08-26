<?php

use Boilerplate\Forms\RegistrationForm;
use Boilerplate\Registration\RegisterUserCommand;

class RegistrationController extends \BaseController {

	/**
	 * @var
	 */
	protected $registrationForm;

	/**
	 * @param RegistrationForm $registrationForm
	 */
	function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;

		// only ones who make it through are guests
		$this->beforeFilter('guest');
	}

	/**
	 * Show the registration form
	 *
	 * @return mixed
	 */
	public function create()
	{
		return View::make('registration.create');
	}

	/**
	 * Stores the users
	 *
	 * @return mixed
	 */
	public function store()
	{
		// validate form
		// errors are returned through the Application Error Handler in start/global/
		$this->registrationForm->validate(Input::all());

		// if valid, user must be added to the database through the RegisterUserCommand, RegisterUserCommandHandler
		// this line is possible thanks to the CommanderTrait in BaseController
		$user = $this->execute(RegisterUserCommand::class);

		// user login
		Auth::login($user);

		// once user is added
		Flash::message(trans('registration.welcome'));

		return Redirect::route('user_account_path');
	}
}