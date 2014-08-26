<?php namespace Boilerplate\Markers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateLatLngFromMarkerCommandHandler implements CommandHandler {

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
		$marker = Marker::updateLatLng(
			$command->id, $command->lat, $command->lng
		);

		$this->markerRepository->updateLatLng($marker, $command->id);

		$this->dispatchEventsFor($marker);

		return $marker;
    }

}