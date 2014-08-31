<?php namespace Boilerplate\Drops;

class AddDropCommand {

	/**
	 * @var
	 */
	public $name;

    /**
     * @var
     */
    public $location;


    /**
     * @param $name
     * @param $formatted_address
     * @param $lat
     * @param $lng
     */
	function __construct($name, $formatted_address, $lat, $lng)
	{
		$this->name = $name;
        $this->location = $formatted_address;
        $this->lat = $lat;
        $this->lng = $lng;
    }

}