<?php

use Boilerplate\Drops\Drop;
use Boilerplate\Markers\MarkerRepository;
use Laracasts\TestDummy\Factory as TestDummy;

class MarkerRepositoryTest extends \Codeception\TestCase\Test {

	/**
	 * @var \IntegrationTester
	 */
	protected $tester;

	protected $repo;

	protected function _before()
	{
		$this->repo = new MarkerRepository();
	}

	protected function _after()
	{
	}

	/** @test */
	public function it_saves_a_marker_for_a_drop()
	{
		// Given I have two drops from a user
		$user = TestDummy::times(1)->create('Boilerplate\Users\User');

		$drops = TestDummy::times(2)->create('Boilerplate\Drops\Drop', [
			'user_id'     => $user->id,
			'name'        => 'Drop',
			'description' => 'Drop description'
		]);

		// Given I have an unsaved marker
		$marker = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'drop_id' => null,
			'name'    => 'Marker 1',
			'lat'     => 3,
			'lng'     => 51
		]);

		// When I save the marker
		$savedMarker = $this->repo->add($marker, $drops[0]->id);

		// Then I should see the marker with the correct dropId
		$this->tester->seeRecord('markers', [
			'name'    => 'Marker 1',
			'lat'     => 3,
			'lng'     => 51,
			'drop_id' => $drops[0]->id
		]);
	}

	/** @test */
	public function it_updates_a_marker_lat_and_lng()
	{
		$lat = 30;
		$lng = 30;

		// Given I have one Maker
		$marker = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name' => 'Marker 1',
			'lat'  => 10,
			'lng'  => 20
		]);

		// When I update the marker lat and long
		$marker->lat = $lat;
		$marker->lng = $lng;
		$savedMarker = $this->repo->updateLatLng($marker, $marker->id);

		// Then I should see the marker with the updated values
		$this->tester->seeRecord('markers', [
			'id'  => $marker->id,
			'lat' => $lat,
			'lng' => $lng
		]);

		$this->assertEquals($lat, $savedMarker->lat);
		$this->assertEquals($lng, $savedMarker->lng);
	}

	/** @test */
	public function it_updates_markers_info()
	{
		$name = 'New name';

		// Given I have one Maker
		$marker = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'      => 'Marker 1',
			'has_event' => 0
		]);

		// When I update the markers info
		$marker->name = $name;
		$marker->has_event = 1;
		$savedMarker = $this->repo->updateInfo($marker, $marker->id);

		// Then I should see the marker with the updated values
		$this->tester->seeRecord('markers', [
			'id'        => $marker->id,
			'name'      => 'New name',
			'has_event' => 1
		]);

		$this->assertEquals($name, $savedMarker->name);
	}

	/** @test */
	public function it_shows_the_marker_by_id()
	{
		// Given I have 2 markers
		$marker1 = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'  => 'Marker 1',
			'order' => '1',
			'lat'   => '10',
			'lng'   => '100'
		]);

		$marker2 = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'  => 'Marker 2',
			'order' => '2',
			'lat'   => '100',
			'lng'   => '10'
		]);

		// When I want to show a marker by Id
		$marker = $this->repo->showById($marker1->id);

		// Then I should get the right marker
		$this->assertEquals('Marker 1', $marker->name);
		$this->assertEquals('1', $marker->order);
		$this->assertEquals('10', $marker->lat);
		$this->assertEquals('100', $marker->lng);
	}

	/** @test */
	public function it_changes_the_order_of_a_marker()
	{
		// Given I have 3 markers
		$marker1 = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'  => 'Marker 1',
			'order' => '1'
		]);

		$marker2 = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'  => 'Marker 2',
			'order' => '2'
		]);

		$marker3 = TestDummy::times(1)->create('Boilerplate\Markers\Marker', [
			'name'  => 'Marker 3',
			'order' => '3'
		]);

		// When I update the order of the markers
		$this->repo->sort(3, $marker1->id);
		$this->repo->sort(2, $marker2->id);
		$this->repo->sort(1, $marker3->id);

		// Then I should see the changed order
		$this->tester->seeRecord('markers', [
			'name'  => 'Marker 1',
			'order' => 3
		]);

		$this->tester->seeRecord('markers', [
			'name'  => 'Marker 2',
			'order' => 2,
		]);

		$this->tester->seeRecord('markers', [
			'name'  => 'Marker 3',
			'order' => 1,
		]);
	}
}