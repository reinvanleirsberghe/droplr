<?php namespace Boilerplate\Markers;

use Boilerplate\Drops\Drop;

class MarkerRepository {

	/**
	 * Adds a marker
	 */
	public function add(Marker $marker, $dropId)
	{
		return Drop::findOrFail($dropId)
			->markers()
			->save($marker);
	}

	/**
	 * Show marker
	 *
	 * @param $id
	 * @return mixed
	 */
	public function showById($id){
		$markerToShow= Marker::findOrFail($id);

		return $markerToShow;
	}

	/**
	 * Updates a marker info
	 *
	 * @param Marker $marker
	 * @param $id
	 * @return mixed
	 */
	public function updateInfo(Marker $marker, $id)
	{
		$markerToUpdate = Marker::findOrFail($id);
		$markerToUpdate->name = $marker->name;
		$markerToUpdate->has_event = $marker->has_event;

		$markerToUpdate->save();
		return $markerToUpdate;
	}

	/**
	 * Updates a marker lat and lng
	 *
	 * @param Marker $marker
	 * @param $id
	 * @return mixed
	 */
	public function updateLatLng(Marker $marker, $id)
	{
		$markerToUpdate = Marker::findOrFail($id);
		$markerToUpdate->lat = $marker->lat;
		$markerToUpdate->lng = $marker->lng;

		$markerToUpdate->save();
		return $markerToUpdate;
	}

	/**
	 * Sort a marker
	 *
	 * @param int $order
	 * @param $id
	 * @return mixed
	 */
	public function sort($order = 9999, $id){
		$markerToSort = Marker::findOrFail($id);
		$markerToSort->order = $order;

		$markerToSort->save();
		return $markerToSort;
	}

	/**
	 * Delete marker
	 *
	 * @param $id
	 */
	public function delete($id)
	{
		return Marker::destroy($id);
	}
}