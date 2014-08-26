<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class MarkerForm extends FormValidator {

	/**
	 * Validation rules for the marker form.
	 *
	 * @var array
	 */
	protected $rules = [
		'name'   => 'required',
		'lat'    => 'required',
		'lng'    => 'required',
		'dropId' => 'required|integer'
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