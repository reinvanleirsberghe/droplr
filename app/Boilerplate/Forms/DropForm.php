<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class DropForm extends FormValidator {

	/**
	 * Validation rules for the drop form.
	 *
	 * @var array
	 */
	protected $rules = [
		'name'        => 'required',
		'description' => 'required',
		'markers_amount' => 'integer|min:2'
	];
} 