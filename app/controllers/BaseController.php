<?php

use Laracasts\Commander\CommanderTrait;

class BaseController extends Controller {

	use CommanderTrait;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		// set variable so it can be seen in all the views
		View::share('currentUser', Auth::user());
	}

}
