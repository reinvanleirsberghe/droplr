<?php namespace Boilerplate\Drops;

class AddDropCommand {

	/**
	 * @var
	 */
	public $name;

	/**
	 * @var
	 */
	public $description;


	/**
	 * @param $name
	 * @param $description
	 */
	function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;
	}

}