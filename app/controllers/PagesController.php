<?php

class PagesController extends \BaseController {

	/**
	 * Show page home
	 *
	 * @return mixed
	 */
	public function home()
	{
		return View::make('pages.home');
	}
}