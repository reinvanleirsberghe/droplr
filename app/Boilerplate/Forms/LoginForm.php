<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator {

	/**
	 * Validation rules for the login form.
	 *
	 * @var array
	 */
	protected $rules = [
		'email'     => 'required',
		'password'  => 'required'
	];
}
