<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class ResetRequestForm extends FormValidator {

    /**
     * Validation rules for the reset form.
     *
     * @var array
     */
    protected $rules = [
        'email'     => 'required'
    ];
}
