<?php

use Boilerplate\Drops\AddDropCommand;
use Boilerplate\Drops\DropRepository;
use Boilerplate\Drops\EditDropCommand;
use Boilerplate\Forms\DropForm;
use Boilerplate\Markers\MarkerRepository;
use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class DropController extends \BaseController {

	/**
	 * @var Boilerplate\Forms\DropForm
	 */
	protected $dropForm;
	protected $dropRepository;
	protected $markerRepository;

	/**
	 * @param DropForm $dropForm
	 * @param Boilerplate\Drops\DropRepository $dropRepository
	 * @param Boilerplate\Markers\MarkerRepository $markerRepository
	 */
	function __construct(DropForm $dropForm, DropRepository $dropRepository, MarkerRepository $markerRepository)
	{
		$this->dropForm = $dropForm;
		$this->dropRepository = $dropRepository;
		$this->markerRepository = $markerRepository;

		$this->beforeFilter('auth');
	}


	/**
	 * Show create view
	 *
	 * @return mixed
	 */
	public function create()
	{
		return View::make('drops.create');
	}

	/**
	 * Stores a drop
	 *
	 * @return mixed
	 */
	public function store()
	{
		$input = Input::get();

		// validate form
		// errors are returned through the Application Error Handler in start/global/
		$this->dropForm->validate($input);

		// if valid
		$drop = $this->execute(AddDropCommand::class, $input);

		// once user is added
		Flash::message(trans('drops.added'));

		return Redirect::route('drops_edit_path', ['id' => $drop->id]);
	}

	/**
	 * Show view of editing a drop
	 *
	 * @param $id
	 * @return mixed
	 */
	public function edit($id)
	{
		$drop = $this->dropRepository->loadForUserById($id);
		$markers = $this->dropRepository->getAllMarkers($drop->id);

		JavaScript::put([
			'currentDropId'     => $drop->id,
			'currenDropMarkers' => $markers
		]);

		return View::make('drops.edit', compact('drop'));
	}

	/**
	 * Deletes a drop
	 *
	 * @param $id
	 */
	public function destroy($id)
	{
		$this->dropRepository->deleteById($id);

		Flash::message(trans('drops.deleted'));

		return Redirect::back();
	}

	/**
	 * Show view info of a drop
	 *
	 * @param $id
	 * @return mixed
	 */
	public function editInfo($id)
	{
		$drop = $this->dropRepository->loadForUserById($id);

		return View::make('drops.edit_info', compact('drop'));
	}

	/**
	 * Update the info of a drop
	 *
	 * @param $id
	 * @return mixed
	 */
	public function update($id)
	{
		$input = array_add(Input::get(), 'id', $id);

		// validate form
		// errors are returned through the Application Error Handler in start/global/
		$this->dropForm->validate($input);

		// if valid
		$drop = $this->execute(EditDropCommand::class, $input);

		// once user is added
		Flash::message(trans('drops.edited'));

		return Redirect::back();
	}

	/**
	 * Sort markers from a drop
	 *
	 * @param $id
	 * @return string
	 */
	public function sortMarkers($id)
	{
		if (Request::ajax())
		{
			$input = array_add(Input::get(), 'dropId', $id);

			$validator = Validator::make(
				array(
					'dropId'    => $input['dropId'],
					'marker-id' => $input['marker-id'],
				),
				array(
					'dropId'    => 'required|integer',
					'marker-id' => 'array'
				)
			);

			// if validation fails
			if ($validator->fails())
			{
				return Response::json([
					'success' => false,
					'error'   => $validator->errors()->toArray()
				]);
			}

			// if validated
			$order = 1;
			foreach ($input['marker-id'] as $markerId)
			{
				$this->markerRepository->sort($order, $markerId);

				$order ++;
			}

			return Response::json([
				'success' => true
			]);
		}
	}
}
