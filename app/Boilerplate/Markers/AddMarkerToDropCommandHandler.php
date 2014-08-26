<?php namespace Boilerplate\Markers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class AddMarkerToDropCommandHandler implements CommandHandler {

	use DispatchableTrait;

	protected $markerRepository;

	function __construct(MarkerRepository $markerRepository)
	{
		$this->markerRepository = $markerRepository;
	}

	/**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
		$marker = Marker::add(
			$command->name, $command->lat, $command->lng
		);

		$this->markerRepository->add($marker, $command->dropId);

		$this->dispatchEventsFor($marker);

		return $marker;
    }

}