<?php

use Boilerplate\Drops\DropRepository;

class APIv1DropController extends \BaseController {

	protected $dropRepository;

	/**
	 * @param Boilerplate\Drops\DropRepository $dropRepository
	 */
	function __construct(DropRepository $dropRepository)
	{
		$this->dropRepository = $dropRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// show all drops
		$drops = $this->dropRepository->getAll();

		return Response::json([
			'success' => true,
			'drops' => $drops
		]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$drop = $this->dropRepository->loadById($id);
		$drop['markers'] = $this->dropRepository->getAllMarkers($drop->id);

		return Response::json([
			'success' => true,
			'drop' => $drop
		]);
	}
}
