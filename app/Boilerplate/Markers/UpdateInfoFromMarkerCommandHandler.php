<?php namespace Boilerplate\Markers;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class UpdateInfoFromMarkerCommandHandler implements CommandHandler {

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
		$marker = Marker::updateInfo(
			$command->id, $command->name, $command->has_event
		);

		$this->markerRepository->updateInfo($marker, $command->id);

		$this->dispatchEventsFor($marker);

		return $marker;
	}

}