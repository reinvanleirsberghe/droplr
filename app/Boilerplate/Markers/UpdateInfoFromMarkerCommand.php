<?php namespace Boilerplate\Markers;

class UpdateInfoFromMarkerCommand {

	/**
	 * @var
	 */
	public $id;

	/**
	 * @var
	 */
	public $name;

	/**
	 * @var
	 */
	public $hasEvent;

	/**
	 * @param $id
	 * @param $name
	 * @param $hasEvent
	 */
	function __construct($id, $name, $hasEvent)
	{
		$this->id = $id;
		$this->name = $name;
		$this->has_event = $hasEvent;
	}

}