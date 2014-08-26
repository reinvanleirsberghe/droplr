<?php

use Boilerplate\Drops\Drop;
use Boilerplate\Drops\DropRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class DropRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	protected $repo;

	protected function _before()
	{
		$this->repo = new DropRepository();
	}

	protected function _after()
	{
	}

	/** @test */
	public function it_gets_all_drops_for_a_user()
	{
		// Given I have two users
		$users = TestDummy::times(2)->create('Boilerplate\Users\User');

		// And drops for both of them
		TestDummy::times(2)->create('Boilerplate\Drops\Drop', [
			'user_id'     => $users[0]->id,
			'name'        => 'Drop 1',
			'description' => 'Drop 1 description'
		]);

		TestDummy::times(2)->create('Boilerplate\Drops\Drop', [
			'user_id'     => $users[1]->id,
			'name'        => 'Drop 2',
			'description' => 'Drop 2 description'
		]);

		// When I fetch statuses for one user
		$DropsForUser = $this->repo->getAllForUser($users[0]);

		// Then I should receive only the relevant ones
		$this->assertCount(2, $DropsForUser);
	}

	/** @test */
	/*public function it_adds_a_drop_for_a_user()
	{
		// Given I have an unsaved drop
		$drop = TestDummy::create('Boilerplate\Drops\Drop', [
			'user_id'     => null,
			'name'        => 'Drop',
			'description' => 'Drop description'
		]);

		// And an existing user
		$user = TestDummy::create('Boilerplate\Users\User');

		// When I try to persist the status
		$savedDrop = $this->repo->add($drop);

		// Then it should be saved
		$this->tester->seeRecord('drops', [
			'name' => 'Drop'
		]);

		// And the status should have the correct user id
		$this->assertEquals($user->id, $savedDrop->user_id);
	}*/

	/** @test */
	public function it_gets_all_markers_of_a_drop()
	{
		// Given I have two drops
		$user = TestDummy::times(1)->create('Boilerplate\Users\User');
		$drops = TestDummy::times(2)->create('Boilerplate\Drops\Drop', [
			'user_id'     => $user->id,
			'name'        => 'Drop 1',
			'description' => 'Drop 1 description'
		]);

		// With one drop 5 markers
		$markersDrop1 = TestDummy::times(5)->create('Boilerplate\Markers\Marker', [
			'drop_id'     => $drops[0]->id,
		]);

		// And the second with 10 markers
		$markersDrop2 = TestDummy::times(10)->create('Boilerplate\Markers\Marker', [
			'drop_id'     => $drops[1]->id,
		]);

		// When I try to get the makers of the second one
		$markers = $this->repo->getAllMarkers($drops[1]->id);

		// I should get 10 markers
		$this->assertCount(10, $markers);
	}
}