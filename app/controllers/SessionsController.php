<?php

use Boilerplate\Forms\LoginForm;

class SessionsController extends \BaseController {

	/**
	 * @var Boilerplate\Forms\LoginForm
	 */
	private $loginForm;

	/**
	 * @param LoginForm $loginForm
	 */
	function __construct(LoginForm $loginForm)
	{
		$this->loginForm = $loginForm;

		$this->beforeFilter('guest', ['except' => 'destroy']);
	}

	/**
	 * Show the login form
	 *
	 * @return mixed
	 */
	public function create()
	{
		return View::make('login.create');
	}

	/**
	 * Logs the user in
	 *
	 * @return mixed
	 */
	public function store()
	{
		$input = Input::only('email', 'password');

		// validate form
		// errors are returned through the Application Error Handler in start/global/
		$this->loginForm->validate($input);

		// if is valid, then try to sign in
		if ( ! Auth::attempt($input))
		{
			Flash::message(trans('login.invalid'));

			return Redirect::back()->withInput();
		}

		// redirect to statuses
		Flash::message(trans('login.welcome'));

		return Redirect::intended('');
	}

	/**
	 * Log a user out
	 *
	 * @return mixed
	 */
	public function destroy()
	{
		Auth::logout();

		Flash::message(trans('login.logged_out'));

		return Redirect::home();
	}
}