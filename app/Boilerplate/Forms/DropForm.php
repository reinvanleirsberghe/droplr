<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class DropForm extends FormValidator {

	/**
	 * Validation rules for the drop form.
	 *
	 * @var array
	 */
	protected $rules = [
		'name'               => 'required',
        'geo'                => 'required',
        'lat'                => 'regex:/^[0-9]+(\\.[0-9]+)?$/',
        'lng'                => 'regex:/^[0-9]+(\\.[0-9]+)?$/',
        'formatted_address'  => 'required'
	];
} 