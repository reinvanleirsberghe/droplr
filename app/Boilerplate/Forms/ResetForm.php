<?php namespace Boilerplate\Forms;

use Laracasts\Validation\FormValidator;

class ResetForm extends FormValidator {

    /**
     * Validation rules for the registration form.
     *
     * @var array
     */
    protected $rules = [
        'email'     => 'required',
        'password'  => 'required|confirmed',
        'password_confirmation' => 'required',
        'token' => 'required'
    ];
}
