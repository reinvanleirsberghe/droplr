<?php namespace Boilerplate\Markers;

class UpdateLatLngFromMarkerCommand {

	/**
	 * @var
	 */
	public $id;

	/**
	 * @var
	 */
	public $lat;

	/**
	 * @var
	 */
	public $lng;

	/**
	 * @param $id
	 * @param $lat
	 * @param $lng
	 */
	function __construct($id, $lat, $lng)
	{
		$this->id = $id;
		$this->lat = $lat;
		$this->lng = $lng;
	}

}