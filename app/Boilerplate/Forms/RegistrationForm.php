<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

	/**
	 * Validation rules for the registration form.
	 *
	 * @var array
	 */
	protected $rules = [
		'name'      => 'required',
		'firstname' => 'required',
		'email'     => 'required|email|unique:users',
		'password'  => 'required'
	];
}
