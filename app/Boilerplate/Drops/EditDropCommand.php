<?php namespace Boilerplate\Drops;

class EditDropCommand {

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
	public $description;

	/**
	 * @param $id
	 * @param $name
	 * @param $description
	 */
	function __construct($id, $name, $description)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
	}

}