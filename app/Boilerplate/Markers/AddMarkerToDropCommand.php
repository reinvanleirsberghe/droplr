<?php namespace Boilerplate\Markers;

class AddMarkerToDropCommand {

	/**
	 * @var
	 */
	public $name;

	/**
	 * @var
	 */
	public $lat;

	/**
	 * @var
	 */
	public $lng;

	/**
	 * @var
	 */
	public $dropId;

	/**
	 * @param $name
	 * @param $lat
	 * @param $lng
	 * @param $dropId
	 */
	function __construct($name, $lat, $lng, $dropId)
	{
		$this->name = $name;
		$this->lat = $lat;
		$this->lng = $lng;
		$this->dropId = $dropId;
	}

}