<?php

use Boilerplate\Forms\ResetForm;
use Boilerplate\Forms\ResetRequestForm;

class RemindersController extends BaseController {

    /**
     * @var Boilerplate\Forms\LoginForm
     */
    protected  $resetForm;

    /**
     * @var Boilerplate\Forms\ResetRequestForm
     */
    protected $resetRequestForm;

    /**
     * @param Boilerplate\Forms\ResetRequestForm $resetRequestForm
     * @param Boilerplate\Forms\ResetForm $resetForm
     */
    function __construct(ResetRequestForm $resetRequestForm, ResetForm $resetForm)
    {
        $this->resetForm = $resetForm;
        $this->resetRequestForm = $resetRequestForm;

        $this->beforeFilter('guest', ['except' => 'destroy']);
    }

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        return View::make('password.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        $formData = Input::only('email');

        // validate form
        // errors are returned through the Application Error Handler in start/global/
        $this->resetRequestForm->validate($formData);

        switch ($response = Password::remind($formData))
        {
            case Password::INVALID_USER:
                return Redirect::back()->withInput()->withErrors(Lang::get($response));

            case Password::REMINDER_SENT:
                Flash::message(Lang::get($response));

                return Redirect::back();
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);

        return View::make('password.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $formData = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        // validate form
        // errors are returned through the Application Error Handler in start/global/
        $this->resetForm->validate($formData);

        $response = Password::reset($formData, function($user, $password)
        {
            $user->password = $password;

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->withInput()->withErrors(Lang::get($response));

            case Password::PASSWORD_RESET:
                Flash::success(trans('reminders.reset_ok'));

                return Redirect::to('/');
        }
    }

}
