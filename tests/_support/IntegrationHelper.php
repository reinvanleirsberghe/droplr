<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class IntegrationHelper extends \Codeception\Module
{
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