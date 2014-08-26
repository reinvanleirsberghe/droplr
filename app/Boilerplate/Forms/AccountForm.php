<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class AccountForm extends FormValidator {

	/**
	 * Validation rules for the registration form.
	 *
	 * @var array
	 */
	protected $rules = [
		'name'      => 'required',
		'firstname' => 'required',
		'email'     => 'required|email|unique:users,email'
	];

	/**
	 * @param array $rules
	 */
	public function setRules($rules)
	{
		$this->rules = $rules;
	}

	/**
	 * @return array
	 */
	public function getRules()
	{
		return $this->rules;
	}

}
