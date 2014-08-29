<?php namespace Boilerplate\Drops;

class AddDropCommand {

	/**
	 * @var
	 */
	public $name;

	/**
	 * @param $name
	 */
	function __construct($name)
	{
		$this->name = $name;
	}

}