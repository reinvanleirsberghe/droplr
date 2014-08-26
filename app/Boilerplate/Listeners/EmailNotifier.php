<?php namespace Boilerplate\Listeners;


use Boilerplate\Users\Events\UserRegistered;
use Laracasts\Commander\Events\EventListener;

class EmailNotifier extends EventListener{

	/**
	 * What to do when a user registered
	 *
	 * @param UserRegistered $event
	 */
	public function whenUserRegistered(UserRegistered $event)
	{
		//var_dump('send email to ' . $event->user->email);
	}
}
