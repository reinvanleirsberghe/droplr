<?php namespace Boilerplate\Markers;

use Boilerplate\Markers\Events\MarkerAdded;
use Boilerplate\Markers\Events\MarkerUpdatedInfo;
use Boilerplate\Markers\Events\MarkerUpdatedLatLng;
use Illuminate\Auth\Reminders\RemindableTrait;

use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Marker extends Eloquent {

	use EventGenerator, DispatchableTrait;

	/**
	 * which fields may be massassigned?
	 * @var array
	 */
	protected $fillable = ['name', 'has_event', 'lat', 'lng', 'dropId'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'markers';

	/**
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * A marker has one drop
	 *
	 * @return mixed
	 */
	public function drop()
	{
		return $this->belongsTo('Boilerplate\Drops\Drop');
	}

	/**
	 * Add marker
	 *
	 * @param $name
	 * @param $lat
	 * @param $lng
	 * @internal param $dropId
	 * @return static
	 */
	public static function add($name, $lat, $lng)
	{
		$marker = new static(compact('name', 'lat', 'lng'));

		// raise event
		$marker->raise(new MarkerAdded($marker));

		return $marker;
	}

	/**
	 * Update marker lat and lng
	 *
	 * @param $id
	 * @param $lat
	 * @param $lng
	 * @return static
	 */
	public static function updateLatLng($id, $lat, $lng)
	{
		$marker = new static(compact('id', 'lat', 'lng'));

		// raise event
		$marker->raise(new MarkerUpdatedLatLng($marker));

		return $marker;
	}

	/**
	 * Update marker info
	 *
	 * @param $id
	 * @param $name
	 * @param $has_event
	 * @return static
	 */
	public static function updateInfo($id, $name, $has_event)
	{
		$marker = new static(compact('id', 'name', 'has_event'));

		// raise event
		$marker->raise(new MarkerUpdatedInfo($marker));

		return $marker;
	}
}
