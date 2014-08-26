<?php namespace Boilerplate\Eventing;

use Illuminate\Support\ServiceProvider;

class EventingServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider
	 */
	public function register()
	{
		$listeners = $this->app['config']->get('boilerplate.listeners');

		foreach ($listeners as $listener)
		{
			$this->app['events']->listen('Boilerplate.*', $listener);
		}
	}
}