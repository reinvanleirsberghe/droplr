<?php namespace Boilerplate\Listeners;

use Boilerplate\Users\Events\UserRegistered;
use Laracasts\Commander\Events\EventListener;

class ReportListener extends EventListener{

	/**
	 * What to do when a user registered
	 *
	 * @param UserRegistered $event
	 */
	public function whenUserRegistered(UserRegistered $event)
	{
		//var_dump('create report of the user ' . $event->user->name);
	}
}
