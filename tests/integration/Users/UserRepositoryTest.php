<?php


use Boilerplate\Users\User;
use Boilerplate\Users\UserRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class UserRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	protected $repo;

	protected function _before()
	{
		$this->repo = new UserRepository();
	}

	protected function _after()
	{
	}

	/** @test */
	public function it_saves_a_user()
	{
		// Given I have a not existing user
		$user = User::register(
			'Foo', 'Bar', 'foobar@example.com', 'secret'
		);

		// When I save the user
		$this->repo->save($user);

		// Then it should be saved
		$this->tester->seeRecord('users', [
			'firstname' => 'Foo',
			'name'      => 'Bar',
			'email'     => 'foobar@example.com'
		]);
	}

	/** @test */
	public function it_updates_a_user(){
		// Given I have a user
		$id = "100";
		$email = "foobar@example.com";
		$firstname = "Foo";
		$name = "Bar";
		$password = "secret";

		$this->tester->haveAnAccount(compact('id', 'firstname', 'name', 'email', 'password'));

		// When I update the user
		$userUpdate = new User;
		$userUpdate->firstname = "John";
		$userUpdate->name = "Bar";
		$userUpdate->email = "johndoe@example.com";

		$this->repo->update($userUpdate, 100);

		// Then it should be updated
		$this->tester->seeRecord('users', [
			'id'		=> 100,
			'firstname' => 'John',
			'name'      => 'Bar',
			'email'     => 'johndoe@example.com'
		]);
	}


}