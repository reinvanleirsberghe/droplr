<?php

use Boilerplate\Forms\MarkerForm;
use Boilerplate\Markers\AddMarkerToDropCommand;
use Boilerplate\Markers\MarkerRepository;
use Boilerplate\Markers\UpdateInfoFromMarkerCommand;
use Boilerplate\Markers\UpdateLatLngFromMarkerCommand;

class MarkerController extends \BaseController {

	/**
	 * @var
	 */
	protected $markerForm;
	/**
	 * @var
	 */
	private $markerRepository;

	/**
	 * @param MarkerForm $markerForm
	 * @param Boilerplate\Markers\MarkerRepository $markerRepository
	 */
	function __construct(MarkerForm $markerForm, MarkerRepository $markerRepository)
	{
		$this->markerForm = $markerForm;
		$this->markerRepository = $markerRepository;

		$this->beforeFilter('auth');
	}

	/**
	 * Stores a marker
	 *
	 * @return string
	 */
	public function store()
	{
		if (Request::ajax())
		{
			$input = Input::all();

			// validate form
			// errors are returned through the Application Error Handler in start/global/
			$this->markerForm->validate($input);

			// if validated
			$marker = $this->execute(AddMarkerToDropCommand::class, $input);

			return Response::json([
				'success' => true,
				'marker' => $marker
			]);
		}
	}

	/**
	 * Show detail from marker
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function show($id)
	{
		if (Request::ajax())
		{
			$marker = $this->markerRepository->showById($id);
			$view = View::make('markers.show', compact('marker'))->render();

			return Response::json([
				'success' => true,
				'marker' => $marker,
				'view' => $view
			]);
		}
	}


	/**
	 * Updates a marker lat and lng
	 *
	 * @param $id
	 * @return string
	 */
	public function updateLatLng($id)
	{
		if (Request::ajax())
		{
			// change rules for the unique field
			$this->markerForm->setRules([
				'lat' => 'required',
				'lng' => 'required'
			]);

			$input = array_add(Input::all(), 'id', $id);

			// validate form
			// errors are returned through the Application Error Handler in start/global/
			$this->markerForm->validate($input);

			// if validated
			$marker = $this->execute(UpdateLatLngFromMarkerCommand::class, $input);

			return Response::json([
				'success' => true,
				'marker'  => $marker
			]);
		}
	}

	/**
	 * Updates info from a marker
	 *
	 * @param $id
	 * @return string
	 */
	public function updateInfo($id)
	{
		if (Request::ajax())
		{
			// change rules for the unique field
			$this->markerForm->setRules([
				'name' => 'required'
			]);

			$input = array_add(Input::all(), 'id', $id);

			// validate form
			// errors are returned through the Application Error Handler in start/global/
			$this->markerForm->validate($input);

			// if validated
			$marker = $this->execute(UpdateInfoFromMarkerCommand::class, $input);

			return Response::json([
				'success' => true,
				'marker'  => $marker
			]);
		}
	}

	/**
	 * Removes a maker
	 *
	 * @param $id
	 * @return string
	 */
	public function destroy($id)
	{
		if (Request::ajax())
		{
			$this->markerRepository->delete($id);

			return Response::json([
				'success' => true
			]);
		}
	}
}
