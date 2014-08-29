<?php namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module {


	/**
	 * Sign in de user
	 */
	public function signIn()
	{
		$email = "foobar@example.com";
		$firstname = "Foo";
		$name = "Bar";
		$password = "secret";

		$this->haveAnAccount(compact('firstname', 'name', 'email', 'password'));

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/');
		$I->click('Log In');
		$I->seeCurrentUrlEquals('/login');
		$I->fillField('email', $email);
		$I->fillField('password', $password);
		$I->click('submit');
	}

	/**
	 * Add a drop
	 *
	 * @param $name
	 */
	public function addADropp($name)
	{
		$I = $this->getModule('Laravel4');

		$I->fillField('name', $name);
		$I->click('submit');
	}

	/**
	 * Create an account
	 *
	 * @param array $overrides
	 */
	public function haveAnAccount($overrides = [])
	{
		$this->have('Boilerplate\Users\User', $overrides);
	}

	/**
	 * @param $model
	 * @param array $overrides
	 */
	public function have($model, $overrides = [])
	{
		TestDummy::create($model, $overrides);
	}
}