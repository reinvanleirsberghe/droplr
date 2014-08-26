<?php namespace Boilerplate\Markers\Events;

use Boilerplate\Markers\Marker;

class MarkerUpdatedLatLng {

	/**
	 * @var \Boilerplate\Markers\Marker
	 */
	public $marker;

	/**
	 * @param Marker $marker
	 */
	function __construct(Marker $marker)
	{
		$this->marker = $marker;
	}
}