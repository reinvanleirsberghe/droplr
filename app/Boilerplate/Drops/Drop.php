<?php namespace Boilerplate\Drops;

use Boilerplate\Drops\Events\DropAdded;
use Boilerplate\Drops\Events\DropEdited;
use Illuminate\Auth\Reminders\RemindableTrait;

use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent;

class Drop extends Eloquent {

	use EventGenerator, DispatchableTrait;

	/**
	 * which fields may be massassigned?
	 * @var array
	 */
	protected $fillable = ['name', 'location', 'lat', 'lng'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'drops';

	/**
	 * @var bool
	 */
	protected $softDelete = true;

	/**
	 * A Drop has one user
	 *
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('Boilerplate\Users\User');
	}

	/**
	 * A drop has many markers
	 *
	 * @return mixed
	 */
	public function markers()
	{
		return $this->hasMany('Boilerplate\Markers\Marker');
	}

    /**
     * Add drop
     *
     * @param $name
     * @param $location
     * @param $lat
     * @param $lng
     * @return static
     */
	public static function add($name, $location, $lat, $lng)
	{
		$drop = new static(compact('name', 'location', 'lat', 'lng'));

		// raise event
		$drop->raise(new DropAdded($drop));

		return $drop;
	}

	/**
	 * Update drop
	 *
	 * @param $name
	 * @param $description
	 * @return static
	 */
	public static function updateInfo($name, $description)
	{
		$drop = new static(compact('name', 'description'));

		// raise event
		$drop->raise(new DropEdited($drop));

		return $drop;
	}
}
